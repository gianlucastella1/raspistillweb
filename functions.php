<?php

	// Parameters definition, used to render HTML and to check inputs
	const PARAMETERS = array(
		'flip' => array(
			'label' => "Flip",
			'name' => "flip",
			'type' => "dropdown",
			'values' => array(
				"None" => "",
				"Horizontally" => "hflip",
				"Vertically" => "vflip",
				"Both" => "hvflip"
			),
			'customInputHandler' => true
		),
		'sharpness' => array(
			'label' => "Sharpness",
			'name' => "sharpness",
			'type' => "numeric",
			'min' => -100,
			'max' => 100,
			'defaultValue' => 0,
			'step' => 1
		),
		'contrast' => array(
			'label' => "Contrast",
			'name' => "contrast",
			'type' => "numeric",
			'min' => -100,
			'max' => 100,
			'defaultValue' => 0,
			'step' => 1
		),
		'brightness' => array(
			'label' => "Brightness",
			'name' => "brightness",
			'type' => "numeric",
			'min' => 0,
			'max' => 100,
			'defaultValue' => 50,
			'step' => 1
		),
		'saturation' => array(
			'label' => "Saturation",
			'name' => "saturation",
			'type' => "numeric",
			'min' => 0,
			'max' => 100,
			'defaultValue' => 50,
			'step' => 1
		),
		'ISO' => array(
			'label' => "ISO",
			'name' => "ISO",
			'type' => "numeric",
			'min' => 100,
			'max' => 800,
			'defaultValue' => 100,
			'step' => 100
		),
		'exposureCompensation' => array(
			'label' => "Exposure Compensation",
			'name' => "exposureCompensation",
			'type' => "numeric",
			'min' => -10,
			'max' => 10,
			'defaultValue' => 0,
			'step' => 1
		),
		'exposure' => array(
			'label' => "Exposure Control",
			'name' => "exposure",
			'type' => "dropdown",
			'values' => array(
				'Automatic mode' => 'auto',
				'Night shooting' => 'night',
				'Night preview' => 'nightpreview',
				'Backlight' => 'backlight',
				'Spotlight' => 'spotlight',
				'Sports' => 'sports',
				'Snow' => 'snow',
				'Beach' => 'beach',
				'Very long exposure' => 'verylong',
				'Fixed FPS' => 'fixedfps',
				'Antishake' => 'antishake',
				'Fireworks' => 'fireworks'
			)
		),
		'whiteBalance' => array(
			'label' => "White Balance",
			'name' => "whiteBalance",
			'type' => "dropdown",
			'values' => array(
				'Automatic mode' => 'auto',
				'Off' => 'off',
				'Sunny mode' => 'sun',
				'Cloudy mode' => 'cloud',
				'Shaded mode' => 'shade',
				'Tungsten lighting mode' => 'tungsten',
				'Fluorescent lighting mode' => 'fluorescent',
				'Incandescent lighting mode' => 'incandescent',
				'Flash mode' => 'flash',
				'Horizon mode' => 'horizon'
			)
		)
	);

	// HTML helper consts
	const LABEL_COL_WIDTH_CLASS = "col-sm-2 col-md-3";
	const CTRL_COL_WIDTH_CLASS = "col-sm-10 col-md-9";

	function getParameterHtml($param, $currentValue) {
		if (!isset($param['type']))
			echo "Type not specified";

		switch ($param['type']) {
			case 'dropdown':
				getDropDownHtml($param, $currentValue);
				break;
			case 'numeric':
				getSliderHtml($param, $currentValue);
				break;
			default:
				break;
		}
	}

	function getDropDownHtml($param, $currentValue) {
		// TODO check param integrity
		// TODO load currentValue
	?>
		<div class="form-group">
          <label for="<?php echo $param['name'] ?>" class="<?php echo LABEL_COL_WIDTH_CLASS ?> control-label"><?php echo $param['label'] ?></label>
          <div class="<?php echo CTRL_COL_WIDTH_CLASS ?>">
            <select name="<?php echo $param['name'] ?>" class="form-control">
    		<?php foreach ($param['values'] as $label => $value) { ?>
    			<option value="<?php echo $value ?>"><?php echo $label ?></option>
    		<?php } ?>            	
            </select>
          </div>
        </div>
	<?php
	}

	function getSliderHtml($param, $currentValue) {
		// TODO check param integrity
		// TODO load currentValue
	?>
		<div class="form-group">
          <label for="<?php echo $param['name'] ?>" class="<?php echo LABEL_COL_WIDTH_CLASS ?> control-label"><?php echo $param['label'] ?></label>
          <div class="<?php echo CTRL_COL_WIDTH_CLASS ?> slider-container">
            <input type="number" name="<?php echo $param['name'] ?>"  class="form-control slider"
            	min="-<?php echo $param['min'] ?>" max="<?php echo $param['max'] ?>" value="0" 
            	data-slider-min="<?php echo $param['min'] ?>" data-slider-max="<?php echo $param['max'] ?>" 
            	data-slider-step="<?php echo $param['step'] ?>" data-slider-value="<?php echo $param['defaultValue'] ?>" >
          </div>
        </div>
	<?php

	}
