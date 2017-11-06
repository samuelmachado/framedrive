<?php

/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 04/10/2017
 * Time: 16:31
 */
putenv("GOOGLE_APPLICATION_CREDENTIALS=".$_SERVER['DOCUMENT_ROOT']."/framedrive/assets/key.json");


// Imports the Google Cloud Storage client library.
use Google\Cloud\Storage\StorageClient;
class Storage
{
    function auth_cloud_implicit($file, $bucket='framedrive-test')
    {

        $config = [
            'projectId' => '613130776400',
        ];

        # If you don't specify credentials when constructing the client, the
        # client library will look for credentials in the environment.
        $storage = new StorageClient($config);

        $bucket = $storage->bucket($bucket);

        $obj =  $bucket->upload(

                fopen($file['tmp_name'], 'r'),
                [
                    'predefinedAcl' => 'publicRead',
                    'name' => $file['name']
                    //
                ]
        );
         return $obj->info();
        }
}
