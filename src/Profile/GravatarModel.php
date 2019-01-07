<?php

namespace Anax\Profile;

class GravatarModel
{
    public function getPicture($email)
    {
        $size = 40;
        $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "&s=" . $size;

        return $grav_url;
    }
}
