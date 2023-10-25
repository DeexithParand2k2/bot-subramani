<?php 
    namespace namespaceGreeting;
    require_once('./assets.php');

    class Greetings{
        public $hyenaGreeting;
        public $ownerGreeting;
        public $hyenaGif;
        public $ownerGif; 

        function __construct($hyenaGreeting,$ownerGreeting){
            $this->hyenaGreeting = $hyenaGreeting.EMOTIONS['happy'];
            $this->ownerGreeting = $ownerGreeting.EMOTIONS['love'];

            //tenor links
            $this->hyenaGif = 'https://tenor.com/bgmIT.gif';
            $this->ownerGif = 'https://tenor.com/ud10l7cMlet.gif';
        }

    }