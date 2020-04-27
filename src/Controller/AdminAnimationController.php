<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\AnimationManager;

/**
 * Class AdminAnimationController
 *
 */
class AdminAnimationController extends AbstractController
{
    const MAX_FILE_SIZE = 1000000;
    const ALLOWED_EXT = ['jpg', 'jpeg', 'png', 'gif'];
    const MAX_NAME_LENGTH = 100;
    const MAX_DESCRIPTION_LENGTH = 500;

    public function index()
    {
        $animationManager = new AnimationManager();
        $animations = $animationManager->selectAll();

        return $this->twig->render('AdminAnimation/index.html.twig', ['animations' => $animations]);
    }

    /**
     * Display animation creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {
        $errors = [];
        $animationManager = new AnimationManager();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
            $file = $_FILES;
            $errors = $this->controlData($data);

            $fileNameNew = '';
            if (!empty($_FILES['image']['name'])) {
                $fileTmp = $file['image']['tmp_name'];
                $fileSize = filesize($fileTmp);
                $fileError = $_FILES['image']['error'];

                $fileExt = explode('.', $_FILES['image']['name']);
                $fileExt = strtolower(end($fileExt));

                if (in_array($fileExt, self::ALLOWED_EXT)) {
                    if ($fileError === 0) {
                        if ($fileSize <= self::MAX_FILE_SIZE) {
                            $fileNameNew = uniqid('', true) . '.' . $fileExt;
                            $fileDestination = '../public/assets/images/' . $fileNameNew;
                            move_uploaded_file($fileNameNew, $fileDestination);

                            if (move_uploaded_file($fileTmp, $fileDestination) == false) {
                                $errors['image'] = "Le téléchargement de {$file['image']['name']} a échoué";
                            }
                        } else {
                            $errors['image'] = "{$file['image']['name']} est trop lourd.
                        Le fichier ne doit pas dépasser " . self::MAX_FILE_SIZE / 1000000 . "Mo";
                        }
                    } else {
                        $errors['image'] = "{$file['image']['name']} errored with code {$fileError}";
                    }
                } else {
                    $errors['image'] = "'{$file['image']['name']}' L'extension '{$fileExt}' n'est pas autorisée.
                Merci de choisir un fichier JPG, JPEG, PNG ou GIF";
                }
            } else {
                $errors['image'] = "Merci d'ajouter une image";
            }

            if (empty($errors)) {
                $data['image'] = $fileNameNew;
                $animationManager->insert($data);
                header('Location:/AdminAnimation/index');
            }
        }
        return $this->twig->render('AdminAnimation/add.html.twig', ['data' => $data ?? [], 'errors' => $errors]);
    }

    private function controlData($data)
    {
        if (empty($data['name'])) {
            $errors['name'] = "Veuillez renseigner le nom de l'animation";
        } elseif (strlen($data['name']) > self::MAX_NAME_LENGTH) {
            $errors['name'] = "Le nom ne doit pas excéder " . self::MAX_NAME_LENGTH . " caractères";
        }

        if (strlen($data['description']) > self::MAX_DESCRIPTION_LENGTH) {
            $errors['description'] = "La description ne doit pas dépasser " .
                self::MAX_DESCRIPTION_LENGTH . " caractères";
        }
        return $errors ?? [];
    }
}