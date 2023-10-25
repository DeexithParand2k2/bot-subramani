<?php

    include __DIR__.'/vendor/autoload.php';

    use Discord\Discord;
    use Discord\Parts\Channel\Message;
    use Discord\WebSockets\Intents;
    use Discord\WebSockets\Event;
    use namespaceGreeting\Greetings;

    require_once('./key.php');
    require_once('./assets.php');
    require_once('./greetings.php');

    $greetings = new Greetings("hello folks I am subramani ","Thalapathy Vijay"); //hynea and owner

    $discord = new Discord([
        'token' => BOT_KEY,
        'intents' => Intents::getDefaultIntents()
    ]);

    $discord->on('ready', function (Discord $discord) use ($greetings) {
        echo "Subramani wakes up!", PHP_EOL;

        // Listen for messages.
        $discord->on(Event::MESSAGE_CREATE, function (Message $message, Discord $discord) use ($greetings) {
            echo "{$message->author->username}: {$message->content}", PHP_EOL;

            $channelId = $message->channel_id;
            $mychannel = $discord->getChannel($channelId);


            // greeting
            if($message->content === '!hi subramani'){
                $mychannel->sendMessage($greetings->hyenaGreeting);
                $mychannel->sendMessage($greetings->hyenaGif);
            } 
            
            if ($message->content === '!owner') {

                $mychannel->sendMessage($greetings->ownerGreeting);
                $mychannel->sendMessage($greetings->ownerGif);
            }

            if ($message->content === '!enemies') {

                $mychannel->sendMessage("I'm trained to attack these guyzz...");

                foreach (ENEMIES as $enemyName => $face) {
                    $mychannel->sendMessage($enemyName);
                    $mychannel->sendMessage($face);
                }

            }

            if ($message->content === '!friends') {

                $mychannel->sendMessage("My fiends areeee...");

                foreach (FRIENDS as $friendName => $face) {
                    $mychannel->sendMessage($friendName);
                    $mychannel->sendMessage($face);
                }

            }

        });
    });

    $discord->run();