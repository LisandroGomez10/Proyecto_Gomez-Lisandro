<?php

namespace CodeIgniterCart\Config;

use CodeIgniter\Config\Services as CoreServices;

class Services extends CoreServices
{
    /**
     * Devuelve la instancia del carrito.
     *
     * @param bool $getShared Si true devuelve la instancia compartida.
     * @return \CodeIgniterCart\Cart\Cart
     */
    public static function cart(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('cart');
        }

        return new \CodeIgniterCart\Cart();
    }
}
