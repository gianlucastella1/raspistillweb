<?php
	require_once __DIR__ . '/functions.php'; 
	require __DIR__ . '/vendor/autoload.php';

	use Cvuorinen\Raspicam\Raspistill;
	

	// Configure camera based on inputs
	// values are validated by Raspistill
	$params = array();

	// all params are handled with a std procedure....
	foreach (PARAMETERS as $key => $value) {
		// ... except those requiring custom input handler
		if (empty($value['customInputHandler'])) {
			if (isset($_REQUEST[$value['name']])) {
				if ($value['type'] == 'numeric') {
					$params[$value['name']] = intval($_REQUEST[$value['name']]);
				}
				else
					$params[$value['name']] = $_REQUEST[$value['name']];
			}
		}
	}

	// parameter with custom input handler
	if (isset($_REQUEST['flip']) && !empty($_REQUEST['flip'])) {
		if ($_REQUEST['flip']=="hflip") {
			$params['horizontalFlip'] = true;
		}
		else if ($_REQUEST['flip']=="vflip") {
			$params['verticalFlip'] = true;
		}
		else if ($_REQUEST['flip']=="hvflip") {
			$params['horizontalFlip'] = true;
			$params['verticalFlip'] = true;
		}
	}

	// fixed parameters
	$params['encoding'] = 'jpg';
	$params['timeout'] = 0.001;
	$params['quality'] = 65;
	$params['sensorMode'] = 6;


	$response = array();
	try {
		$folder = '/pictures';
		$phisical_path = __DIR__  . $folder;

		if (!file_exists($phisical_path)) {
			if (!mkdir($phisical_path))
				throw new Exception("Unable to create $phisical_path folder. Check permissions.");
		}
		$picture = mktime().".jpg";
		$camera = new Raspistill($params);
		$camera->takePicture($phisical_path . '/' . $picture);

		$response['status'] = 'ok';
		$response['picture'] = '.' . $folder . '/' . $picture;
	} catch (Exception $ex) {
		$response['status'] = 'fail';
		$response['error'] = $ex->getMessage();

	}

	header('Content-type: application/json');
	echo json_encode($response);
	