<?php
class Users extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function index() {
        redirect('welcome');
    }

    public function register() {
        if ($this->isLoggedIn()) {
            redirect('welcome');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Nettoyage des données reçues
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Validation des champs
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter a name';
            }

            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter an email';
            } else {
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already taken.';
                }
            }

            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter a password.';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must have at least 6 characters.';
            }

            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password.';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match.';
                }
            }

            // Vérification des erreurs
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // Hachage du mot de passe
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Enregistrement de l'utilisateur
                if ($this->userModel->register($data)) {
                    flash('register_success', 'You are now registered and can log in');
                    redirect('users/login');
                } else {
                    die('Une erreur est survenue');
                }
            } else {
                // Charger la vue avec les erreurs
                $this->view('users/register', $data);
            }
        } else {
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Charger la vue
            $this->view('users/register', $data);
        }
    }

    public function login() {
      if ($this->isLoggedIn()) {
          redirect('welcome');
      }
  
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          // Nettoyage des données
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  
          $data = [
              'email' => trim($_POST['email']),
              'password' => trim($_POST['password']),
              'email_err' => '',
              'password_err' => '',
          ];
  
          // Validation des champs
          if (empty($data['email'])) {
              $data['email_err'] = 'Please enter email.';
          }
  
          if (empty($data['password'])) {
              $data['password_err'] = 'Please enter password.';
          }
  
          // Vérification des erreurs avant d'aller plus loin
          if (empty($data['email_err']) && empty($data['password_err'])) {
              // Vérifier si l'utilisateur existe
              if ($this->userModel->findUserByEmail($data['email'])) {
                  // Utilisateur trouvé, on tente de le connecter
                  $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                  
                  // Ajout d'un test ici pour vérifier ce que `login` retourne
                  if ($loggedInUser) {
                      // Vérification du mot de passe réussie
                      // Créer la session utilisateur
                      $this->createUserSession($loggedInUser);
                  } else {
                      // Si le mot de passe est incorrect
                      $data['password_err'] = 'Password incorrect.';
                      error_log("Password incorrect for email: " . $data['email']); // Log pour vérifier l'erreur
                  }
              } else {
                  // Si l'email n'existe pas
                  $data['email_err'] = 'This email is not registered.';
                  error_log("Email not registered: " . $data['email']); // Log pour vérifier l'erreur
              }
          }
  
          // Si des erreurs existent
          if (!empty($data['email_err']) || !empty($data['password_err'])) {
              $this->view('users/login', $data);
          }
      } else {
          // Initialisation des champs si la requête n'est pas POST
          $data = [
              'email' => '',
              'password' => '',
              'email_err' => '',
              'password_err' => '',
          ];
  
          // Charger la vue
          $this->view('users/login', $data);
      }
  }
  

    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        redirect('welcome');
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('index');
    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function admi() {
        $this->view('users/admi');
    }
}
