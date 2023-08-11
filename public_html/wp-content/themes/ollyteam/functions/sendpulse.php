<?

	require __DIR__ . '/libs/sendpulse/ApiInterface.php';
	require __DIR__ . '/libs/sendpulse/ApiClient.php';
	require __DIR__ . '/libs/sendpulse/Storage/TokenStorageInterface.php';
	require __DIR__ . '/libs/sendpulse/Storage/FileStorage.php';
	require __DIR__ . '/libs/sendpulse/Storage/SessionStorage.php';
	require __DIR__ . '/libs/sendpulse/Storage/MemcachedStorage.php';
	require __DIR__ . '/libs/sendpulse/Storage/MemcacheStorage.php';
	
	define('API_USER_ID', '770db57e618ab06505042fa780074cf3');
	define('API_SECRET', 'dd0215093ffb175ddf3c7b1f8729bfcb');
	define('PATH_TO_ATTACH_FILE', __FILE__);
	
	use Sendpulse\RestApi\ApiClient;
	use Sendpulse\RestApi\Storage\FileStorage;
	
	$SPApiClient = new ApiClient(API_USER_ID, API_SECRET, new FileStorage());
	
	