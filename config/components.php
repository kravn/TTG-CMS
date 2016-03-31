<?php

$xml = 'https://ams-games.ttms.co/userinfo/servlet/TaskServlet?taskId=540&seq=1&formatType=xml&deviceType=web&lsdId=zero&accName=FunAcct&lang=en&playerHandle=999999';
$affiliateId = 'generic';
$playerHandle = '999999';
$account = 'USD';
$lang = 'en';

return [
    'game_xml' => $xml,
    'xml' => file_get_contents($xml),
    'host' => 'https://ams-games.stg.ttms.co/',
    'game_launch' =>  'casino/' . $affiliateId . '/game/game.html',
    'game_suffix' => '?playerHandle=' . $playerHandle . '&account=' . $account. '&lang=' . $lang . '&lsdId=zero',
    'api_module' => [
        'account' => [
            'components' => [
                'player' => [
                    'host' => 'https://ams-games.ttms.stg.co/player/',
                    'class'	=> 'account.components.PlayerAPI',
                    'lsdid'	=> 'zero', //jmtmg - jmttg - jmt
                    'action' => [
                        'login'		    => 'Player.action?login',
                        'logout'	    => 'Player.action?logout',

                        'create'	    => 'Register.action?save',
                        'profile'	    => 'Register.action?edit',
                        'update'	    => 'Register.action?update',
                        'validate'      => 'Register.action?validateCode',
                        'currencies'    => 'CwhCurrency.action',

                        'recover_user'  => 'Forgot.action?recoverUsername',
                        'recover_password' => 'Forgot.action?recoverPassword',

                        'balance'	    => '../casino/servlet/com.chartwelltechnology.servlet.myaccount.MyAccountSupportServlet',
                        'cashier'       => 'CashierSystem.action?launchCashier', //CashierSystem.action?launchCashier
                        'mock_cashier'  => 'CashierSystem.action?launchCashier&mockCashier=true',
                        'myaccount'     => '../userinfo/servlet/TaskServlet?taskId=5001&seq=1&formatType=cmahtml&jTransform=true',
                    ]
                ],
            ],
        ],
        'game' => [
            'components' => [
                'host' => 'https://ams-games.stg.ttms.co/',
                'action' => [
                    'menu'          => 'player/Menu.action?getMenu', //userinfo/servlet/TaskServlet?taskId=540&seq=1&formatType=xml
                    'launch'	    => 'casino/default/game/game.html',
                    'consolelaunch' => 'casino/game/democonsole/demo.html',
                    'images'	    => 'player/images/games/',
                    'jackpots'      => 'player/JackpotList.action?getJackpotsByLsdId',
                ],
                'class'	=> 'Gaming',
                'currency' => 'CNY',
                'extension' => 'png',
                'lsdid'	=> 'zero',
                // /casino/generic/game/game.html?playerHandle=100099302592520894344696842842157555&account=CNY&gameName=YearOfTheMonkey&gameType=0&gameId=1035&lang=en&lsdId=zero
            ],
        ],
    ],
];