<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'admin/login/validate',
        'user/login/validate',
        'course/{course}/collect/validate',
        'admin/register/validate',
        'user/register/validate',
        '/admin/add_course/validate',
        '/admin/course/{course}/upload/video/validate',
        '/admin/course/{course}/upload/textbook/validate',
        '/admin/course/{course}/upload/textbook',
    ];
}
