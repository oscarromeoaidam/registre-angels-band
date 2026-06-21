<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    // ✅ ENREGISTREMENT DES MIDDLEWARES
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => AdminMiddleware::class,
        ]);

        // Railway (et la plupart des hebergeurs cloud) font du TLS termination :
        // le HTTPS s'arrete au niveau du proxy, puis la requete arrive en HTTP
        // simple au conteneur. Sans cette ligne, Laravel ne sait pas que la
        // requete d'origine etait en HTTPS et genere des URLs en http://,
        // ce qui declenche l'avertissement "formulaire non securise" du navigateur.
        $middleware->trustProxies(at: '*');
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })

    ->create();
