<?php


namespace App\Applicants\Application\Service;


class NameGenerator implements GeneratorInterface
{

    public function generate()
    {
        $alphabetic = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        $name = '';
        for($i = 0; $i < rand(5, 10); $i++) {
            $name .= $alphabetic[rand(0, strlen($alphabetic)-1)];
        }
        return $name;
    }
}