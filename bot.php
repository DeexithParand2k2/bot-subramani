<?php

    include __DIR__.'/vendor/autoload.php';

    use Discord\Discord;
    use Discord\Parts\Channel\Message;
    use Discord\WebSockets\Intents;
    use Discord\WebSockets\Event;

    require_once('./key.php');
    require_once('./assets.php');

    $discord = new Discord([
        'token' => BOT_KEY,
        'intents' => Intents::getDefaultIntents()
    ]);

    $discord->on('ready', function (Discord $discord) {
        echo "Subramani wakes up!", PHP_EOL;

        // Listen for messages.
        $discord->on(Event::MESSAGE_CREATE, function (Message $message, Discord $discord) {
            echo "{$message->author->username}: {$message->content}", PHP_EOL;

            $channelId = $message->channel_id;
            $mychannel = $discord->getChannel($channelId);


            // greeting
            if($message->content === 'hi'){
                $mychannel->sendMessage('Heeehheee');
            } 
            
            if ($message->content === '!owner') {
                $mychannel->sendMessage("Annan yaaru thalapathy");
                $mychannel->sendMessage('https://tenor.com/ud10l7cMlet.gif');
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