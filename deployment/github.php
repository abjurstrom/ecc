<?php
$here     = dirname(__FILE__);
$log_file = fopen($here.'/log.txt', 'a');
if ($log_file !== FALSE)
{
    $payload = $_POST['payload'];
    $post_r = print_r(json_decode($payload, TRUE), TRUE);
    fwrite($log_file, $post_r);
    fwrite($log_file, PHP_EOL.'==='.PHP_EOL.'==='.PHP_EOL);
    fclose($log_file);
    echo '<h1>Log Dump:</h1>';
    echo '<pre>'.$post_r.'</pre>';
}
else
{
    echo '<h1>Log file failed to open.</h1>';
}

// Make sure we have a payload, stop if we do not.
if( ! isset( $_POST['payload'] ) )
	die( '<h1>No payload present</h1><p>A GitHub POST payload is required to deploy from this script.</p>' );

/**
 * Tell the script this is an active end point.
 */
define( 'ACTIVE_DEPLOY_ENDPOINT', true );

require_once 'deploy-config.php';

/**
 * Deploys GitHub git repos
 */
class GitHub_Deploy extends Deploy {
	/**
	 * Decodes and validates the data from github and calls the 
	 * doploy contructor to deoploy the new code.
	 *
	 * @param 	string 	$payload 	The JSON encoded payload data.
	 */
	function __construct( $payload ) {
		$payload = json_decode( $_POST['payload'] );
		$name = $payload->repository->name;
		$branch = basename( $payload->ref );
		$commit = substr( $payload->commits[0]->id, 0, 12 );
		if ( isset( parent::$repos[ $name ] ) && parent::$repos[ $name ]['branch'] === $branch ) {
			$data = parent::$repos[ $name ];
			$data['commit'] = $commit;
			parent::__construct( $name, $data );
		}
        else
        {
            $here     = dirname(__FILE__);
            $log_file = fopen($here.'/log.txt', 'a');
            if ($log_file !== FALSE)
            {
                $repos_r = print_r(parent::$repos, TRUE);
                fwrite($log_file, PHP_EOL.'!!!'.PHP_EOL.'!!!'.PHP_EOL);
                fwrite($log_file, 'Failed to catch a correct config in:'.PHP_EOL);
                fwrite($log_file, $repos_r);
                fwrite($log_file, PHP_EOL.'!!!'.PHP_EOL.'!!!'.PHP_EOL);
                fclose($log_file);
            }
        }
	}
}
// Starts the deploy attempt.
new GitHub_Deploy( $_POST['payload'] );