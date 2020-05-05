<?php


namespace App\Controller;

use App\Model\RoomManager;

class AdminRoomController extends AbstractController
{
    public function index()
    {
        $roomManager = new RoomManager();
        $rooms = $roomManager->selectRoomByAddress();
        $roomByAddresses = [];
        $addresses = $roomManager->selectAddress();
        foreach ($rooms as $room) {
            $roomName = $room['name'];
            $roomByAddresses[$roomName][] = $room;
        }
        return $this->twig->render('AdminRoom/index.html.twig', ['roomByAddresses' => $roomByAddresses,
            'addresses'=> $addresses]);
    }
    public function addAddress()
    {
        $adminRoomManager = new RoomManager();
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
            $errors = $this->controlAddress($data);
            if (empty($errors)) {
                $adminRoomManager->insertAddress($data);
                header('Location:/AdminRoom/index');
            }
        }
        return $this->twig->render('AdminRoom/addAddress.html.twig', [
            'data'=> $data ?? [],
            'errors'=> $errors ?? []]);
    }
    private function controlAddress($data)
    {
        $errors = [];
        if (empty($data['name'])) {
            $errors['name'] = 'Le nom du logement ne doit pas être vide';
        } elseif (strlen($data['name']) > 255) {
            $errors['name'] = 'Le nom du logement est trop long';
        }
        if (empty($data['address'])) {
            $errors['address'] = 'L\'adresse du logement ne doit pas être vide';
        } elseif (strlen($data['address']) > 255) {
            $errors['address'] = 'L\'adresse du logement est trop longue';
        }

        return $errors ?? [];
    }
}
