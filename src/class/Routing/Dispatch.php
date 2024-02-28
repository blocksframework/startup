<?php

namespace Blocks\Startup\Routing;

use Blocks\Startup\Routing\RoutableInterface;

class Dispatch implements RoutableInterface {
    private $class;            
    private $matches = [];

    public function __construct($class) {
        $this->class = '\\' . $class;
    }

    public function setMatches(array $matches): void {
        $this->matches = $matches;
    }

    public function run() {
        if ( is_callable( [ $this->class, 'get' ] ) ) {
            $controller = new $this->class();

            $controller->setUrlParams( $this->matches );

            return $controller->get();

        } else {
            trigger_error('Controller "' . $this->class . '", method get is not callable', E_USER_ERROR);
        }
    }

    public function execute(): void {
    }

}