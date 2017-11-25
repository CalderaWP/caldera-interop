<?php


namespace calderawp\interop;

/**
 * Get Interop system as plugin/app
 *
 * @return \calderawp\interop\InteropApp
 */
function Interop(){
    static $calderaInterop;
    if( ! $calderaInterop ){
        $calderaInterop = new \calderawp\interop\InteropApp(
            new ServiceContainer(),
            getBasePath(),
            getMeta()->version

        );
    }

    return $calderaInterop;
}

/**
 * @return string
 */
function getBasePath()
{
    return  dirname( __FILE__, 2 );
}

/**
 * @return object
 */
function getMeta(){
    static $calderaInteropMeta;
    if( ! $calderaInteropMeta ){
        $calderaInteropMeta = json_decode( file_get_contents( getBasePath() . '/meta.json' ) );
    }
    return $calderaInteropMeta;
}