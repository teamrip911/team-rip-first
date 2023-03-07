<?php

namespace App\Factory;

use App\Entity\Category;
use App\Entity\Note;
use App\Entity\User;

class NoteFactory
{
    public static function create(
        string $title,
        string $text,
        User $user,
        Category $category
    ): Note {
        $note = new Note();
        $note->setTitle($title);
        $note->setText($text);
        $note->setUser($user);
        $note->setCategory($category);

        return $note;
    }
}
