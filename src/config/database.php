<?php
return array(
     'connections' => array(
          'fileserver' => array(
               'driver'   => 'mongodb',
               'host'     => 'localhost',
               'port'     => 27017,
               'username' => 'username',
               'password' => 'password',
               'database' => 'database'
               ),

          /* 'fileserver' => array( */
          /*      'driver'   => 'mongodb', */
          /*      'host'     => array('server1', 'server2'), */
          /*      'port'     => 27017, */
          /*      'username' => 'username', */
          /*      'password' => 'password', */
          /*      'database' => 'database', */
          /*      'options'  => array('replicaSet' => 'replicaSetName') */
          /*      ), */
          )
     );