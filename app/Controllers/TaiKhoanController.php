<?php
// app/Controllers/TaiKhoanController.php
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(__DIR__, 2));
}
require_once __DIR__ . '/../config/BaseController.php';

class TaiKhoanController extends BaseController
{
    private $userModel;
    private $userId;
    private $username;
    private $role;

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }
    // Hiển thị form đăng ký
    public function showRegisterForm()
    {
        $this->view('Auth.register');
    }
    public function createUser($username, $password, $email, $role) {
        $userModel = new User();
        return $userModel->addUser($username, password_hash($password, PASSWORD_DEFAULT), $email, $role);
    }
    
    // Xử lý đăng ký
    public function register($data)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';
            $role = $_POST['role'] ?? '';

            // Validate dữ liệu
            if (empty($username) || empty($email) || empty($password) || empty($role)) {
                $this->view('Auth.register', ['error' => 'Vui lòng điền đầy đủ thông tin']);
                return;
            }

            if ($password !== $confirm_password) {
                $this->view('Auth.register', ['error' => 'Mật khẩu không khớp']);
                return;
            }

            // Kiểm tra usernamw đã tồn tại chưa
            if ($this->userModel->getUserByUsername($username)) {
                $this->view('Auth.register', ['error' => 'Tên đăng nhập đã tồn tại']);
                return;
            }

            // Mã hóa mật khẩu
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Tạo tài khoản
            $result = $this->userModel->createUser([
                'username' => $username,
                'email' => $email,
                'password' => $hashedPassword,
                'role' => $role
            ]);

            if ($result) {
                // Chuyển hướng đến đăng nhập
                session_start();
                $_SESSION['success'] = "Đăng ký thành công! Vui lòng đăng nhập.";
                $this->redirect('/qltv_mvc/app/Views/Auth/login.php');
                return true;
            } else {
                $this->view('Auth.register', ['error' => 'Đăng ký thất bại']);
                return "Đăng ký thất bại. Vui lòng thử lại.";
            }
        }
    }

    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        $this->view('Auth.login');
    }

    public function login($data)
    {

        // Xử lý đăng nhập

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            // Validate dữ liệu
            if (empty($username) || empty($password)) {
                $this->view('Auth.login', ['error' => 'Vui lòng điền đầy đủ thông tin']);
                return;
            }

            // Kiểm tra tài khoản
            $user = $this->userModel->getUserByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                // Bắt đầu session
                session_start();
                $this->userId = $user['id'];
                $this->username = $user['username'];
                $this->role = $user['role'];
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['success'] = 'Đăng nhập thành công';
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'role' => $user['role']
                ];

                // Chuyển hướng đến trang dashboard
                if ($user['role'] === '2') {
                    $this->redirect('/qltv_mvc/app/Views/thu_thu/dashboard.php');
                } elseif ($user['role'] === '3') {
                    $this->redirect('/qltv_mvc/app/Views/admin/dashboard.php');
                }
                else {
                    $this->redirect('/qltv_mvc/app/Views/doc_gia/dashboard.php');
                }
                //$this->redirect($user['role'] === '2' ? '.thu_thu.dashboard' : '.doc_gia.dashboard');
                return true;
            } else {
                $this->view('Auth.login', ['error' => 'Tên đăng nhập hoặc mật khẩu không đúng']);
                return "Đăng nhập thất bại.";
            }
        }
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getRole()
    {
        return $this->role;
    }

    // Đăng xuất
    public function logout()
    {
        session_start();
        session_destroy();
        session_unset();
        $this->redirect('/qltv_mvc/app/Views/Auth/login.php');
    }

    // Hiển thị form quên mật khẩu
    public function showForgotPasswordForm()
    {
        $this->view('Auth.forgot_password');
    }

    // Xử lý quên mật khẩu
    public function forgotPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';

            // Validate email
            if (empty($email)) {
                $this->view('Auth.forgot_password', ['error' => true, 'message' => 'Vui lòng nhập email']);
                return;
            }

            // Kiểm tra email tồn tại
            $user = $this->userModel->getUserByEmail($email);

            if ($user) {
                // Tạo mã token đặt lại
                $resetToken = bin2hex(random_bytes(32));
                $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

                // Lưu token vào database
                $this->userModel->saveResetToken($user['id'], $resetToken, $expiry);

                // Gửi email chứa liên kết đặt lại mật khẩu
                $resetLink = "http://khaidangiuu.com/reset-password?token={$resetToken}";

                // Hiển thị thông báo
                $this->view('Auth.forgot_password', ['message' => 'Đã gửi liên kết đặt lại mật khẩu. Vui lòng kiểm tra email.']);
            } else {
                $this->view('Auth.forgot_password', ['error' => true, 'message' => 'Không tìm thấy tài khoản với email này']);
            }
        }
    }

    // Hiển thị form đặt lại mật khẩu
    public function showResetPasswordForm($token)
    {
        // Kiểm tra token
        $user = $this->userModel->getUserByResetToken($token);

        if ($user && strtotime($user['reset_token_expiry']) > time()) {
            $this->view('Auth.reset_password', ['token' => $token]);
        } else {
            $this->view('Auth.forgot_password', ['error' => true, 'message' => 'Liên kết không hợp lệ hoặc đã hết hạn']);
        }
    }

    // Xử lý đặt lại mật khẩu
    public function resetPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['token'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            // Validate mật khẩu
            if (empty($password) || $password !== $confirm_password) {
                $this->view('Auth.reset_password', ['token' => $token, 'error' => 'Mật khẩu không khớp']);
                return;
            }

            // Kiểm tra token
            $user = $this->userModel->getUserByResetToken($token);

            if ($user && strtotime($user['reset_token_expiry']) > time()) {
                // Mã hóa mật khẩu mới
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Cập nhật mật khẩu
                $this->userModel->updatePassword($user['id'], $hashedPassword);

                // Xóa token
                $this->userModel->clearResetToken($user['id']);

                $this->redirect('/login');
            } else {
                $this->view('Auth.forgot_password', ['error' => true, 'message' => 'Liên kết không hợp lệ hoặc đã hết hạn']);
            }
        }
    }

    // Thay đổi mật khẩu

    public function showChangePasswordForm()
    {
        $this->checkAuth(); // Đảm bảo người dùng đã đăng nhập
        $this->view('Auth.change_password');
    }

    public function changePassword()
    {
        $this->checkAuth(); // Đảm bảo người dùng đã đăng nhập

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $currentPassword = $_POST['current_password'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';
            $confirmNewPassword = $_POST['confirm_new_password'] ?? '';

            // Validate dữ liệu
            if (empty($currentPassword) || empty($newPassword) || empty($confirmNewPassword)) {
                $this->view('Auth.change_password', ['error' => 'Vui lòng điền đầy đủ thông tin']);
                return;
            }

            if ($newPassword !== $confirmNewPassword) {
                $this->view('Auth.change_password', ['error' => 'Mật khẩu mới không khớp']);
                return;
            }

            // Kiểm tra mật khẩu hiện tại
            $userId = $_SESSION['user']['id'];
            if (!$this->userModel->verifyCurrentPassword($userId, $currentPassword)) {
                $this->view('Auth.change_password', ['error' => 'Mật khẩu hiện tại không đúng']);
                return;
            }

            // Thay đổi mật khẩu
            $result = $this->userModel->changePassword($userId, $newPassword);

            if ($result) {
                $this->view('Auth.change_password', ['success' => 'Thay đổi mật khẩu thành công']);
            } else {
                $this->view('Auth.change_password', ['error' => 'Thay đổi mật khẩu thất bại']);
            }
        }
    }
}
