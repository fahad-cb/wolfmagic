<?php

	/**
	* 
	*/

	class ImageWolf extends HuntHelp
	{
		function add_magic($photo_path, $output, $magic, $extra = false) {
			if ($this->is_photo($photo_path)) {
				$command = "convert $photo_path ";
				switch ($magic) {
					case 'resize':
						$command .= " -resize $extra ";
						break;
					case 'rotate':
						$command .= " -rotate $extra ";
						break;
					case 'flip':
						if ($extra == 'h') {
							$extra = 'flop'; // horizental
						} else {
							$extra = 'flip'; // vertical
						}
						$command .= " -$extra ";
						break;
					case 'grayscale':
						$command .= " -type Grayscale ";
						break;
					case 'navy':
						$command .= " +level-colors navy,lemonchiffon ";
						break;
					case 'fire':
						$command .=" +level-colors firebrick,$extra ";
						break;
					case 'rgba':
						$command .= ' +level-colors \'rgb('.$extra.')\',lemonchiffon ';
						break;
					case 'sepia':
						$command .= " -sepia-tone $extra ";
						break;
					case 'blur':
						$command .= " $extra ";
						break;
					case 'invert':
						$command .= " -negate ";
						break;
					case 'oil':
						$command .= " -paint $extra ";
						break;
					case 'charcoal':
						$command .= " -charcoal $extra ";
						break;
					case 'emboss':
						$command .= " -emboss $extra ";
						break;
					case 'edge_detect':
						$command .= " -colorspace Gray -negate -edge $extra ";
						break;
					case 'shade':
						$command .= " -shade $extra ";
						break;
					default:
						# code...
						break;
				}

				$command .= " $output ";
				$this->cmd($command);
				if (file_exists($output)) {
					return $output;
				} else {
					return false;
				}
			}
		}

		function convert($photo_path, $output, $resize = false) {
			if ($resize) {
				$this->add_magic($photo_path, $output, 'resize', $resize);
			} else {
				$this->add_magic($photo_path, $output);
			}
		}

		function add_text($params) {
			if (is_array($params)) {
				$photo_path = $params['photo_path'];
				$output = $params['output'];
				$text = $params['text'];

				if (isset($params['color'])) {
					$color = $params['color'];
				} else {
					$color = 'white';
				}

				if (isset($params['font_size'])) {
					$fontsize = $params['font_size'];
				} else {
					$fontsize = '20';
				}

				if (isset($params['fromtop'])) {
					$fromtop = $params['fromtop'];
				} else {
					$fromtop = '50';
				}
				
				if (isset($params['fromleft'])) {
					$fromleft = $params['fromleft'];
				} else {
					$fromleft = '50';
				}

				if (isset($params['font'])) {
					$font = $params['font'];
				} else {
					$font = 'Arial';
				}

				if (isset($params['bg'])) {
					$bg = " -box '".$params['bg']."' ";
				} else {
					$bg = '';
				}

				if (isset($params['extra'])) {
					$extra = $params['extra'];
				} else {
					$extra = '';
				}

				if ($this->is_photo($photo_path)) {
					$command = "convert $photo_path -font $font -fill $color -pointsize $fontsize -annotate +$fromtop+$fromleft $extra $text $output";
					$this->cmd($command);
					if (file_exists($output)) {
						return $output;
					} else {
						return false;
					}
				}
			}
		}

		function text_image($params) {
			$text = $params['text'];
			$output = $params['output'];

			if (isset($params['color'])) {
				$color = $params['color'];
			} else {
				$color = 'white';
			}

			if (isset($params['font_size'])) {
				$fontsize = $params['font_size'];
			} else {
				$fontsize = '20';
			}

			if (isset($params['font'])) {
				$font = $params['font'];
			} else {
				$font = 'Arial';
			}

			if (isset($params['extra'])) {
				$extra = $params['extra'];
			} else {
				$extra = '';
			}

			$command = "convert -font $font -pointsize $fontsize  label:\"$text\" $output";
			$this->cmd($command);
			if (file_exists($output)) {
				return $output;
			} else {
				return false;
			}
		}

		function rotate($photo_path, $output, $rotate = '45') {
			$this->add_magic($photo_path, $output, 'rotate', $rotate);
		}

		function flip($photo_path, $output, $flipto = 'h') {
			$this->add_magic($photo_path, $output, 'flip', $flipto);
		}

		function flip_vertical($photo_path, $output) {
			$this->flip($photo_path, $output, 'v');
		}

		function flip_horizental($photo_path, $output) {
			$this->flip($photo_path, $output);
		}

		function grayscale($photo_path, $output, $unlink = false) {
			$this0->add_magic($photo_path, $output, 'grayscale');
		}

		function navy($photo_path, $output) {
			$this->add_magic($photo_path, $output, 'navy');
		}

		function fire($photo_path, $output, $color = 'yellow') {
			$this->add_magic($photo_path, $output, 'fire', $color);
		}

		function green_fire($photo_path, $output) {
			$this->add_magic($photo_path, $output, 'fire', $color);
		}

		function pink_fire($photo_path, $output) {
			$this->add_magic($photo_path, $output, 'fire', 'pink');
		}

		function orange_fire($photo_path, $output) {
			$this->add_magic($photo_path, $output, 'fire', 'orange');
		}

		function black_fire($photo_path, $output) {
			$this->add_magic($photo_path, $output, 'fire', 'black');
		}

		function hex_fire($photo_path, $output, $hex) {
			# $hex = #color_code
			$this->add_magic($photo_path, $output, 'fire', $hex);
		}

		// rgba code only e.g 0,0,21,12
		function rgba($photo_path, $output, $rgba_code) {
			$this->add_magic($photo_path, $output, 'rgba', $rgba_code);
		}

		function sepia($photo_path, $output, $tone = '80%') {
			$this->add_magic($photo_path, $output, 'speia', $tone);
		}

		function invert($photo_path, $output) {
			$this->add_magic($photo_path, $output, 'invert');
		}

		function blur_image($photo_path, $output, $border_color = 'white', $border = '20x10', $blurness = '5x3') {
			$this->add_magic($photo_path, $output, 'blur', " -bordercolor $border_color -border $border -blur $blurness");
		}

		function oil_paint($photo_path, $output, $oil) {
			$this->add_magic($photo_path, $output, 'oil', $oil);
		}

		function charcoal($photo_path, $output, $charcoal) {
			$this->add_magic($photo_path, $output, 'charcoal', $charcoal);
		}

		function emboss($photo_path, $output, $emboss) {
			$this->add_magic($photo_path, $output, 'emboss', $emboss);
		}

		function add_toaster($photo_path, $output) {
			try	{
			    $instagraph = Instagraph::factory($photo_path, $output);
			}
			catch (Exception $e) {
			    echo $e->getMessage();
			    die;
			}
			 
			$instagraph->toaster();
		}

		function add_gotham($photo_path, $output) {
			try	{
			    $instagraph = Instagraph::factory($photo_path, $output);
			}
			catch (Exception $e) {
			    echo $e->getMessage();
			    die;
			}
			 
			$instagraph->gotham();
		}

		function add_kelvin($photo_path, $output) {
			try	{
			    $instagraph = Instagraph::factory($photo_path, $output);
			}
			catch (Exception $e) {
			    echo $e->getMessage();
			    die;
			}
			 
			$instagraph->kelvin();
		}
		
		function add_lomo($photo_path, $output) {
			try	{
			    $instagraph = Instagraph::factory($photo_path, $output);
			}
			catch (Exception $e) {
			    echo $e->getMessage();
			    die;
			}
			 
			$instagraph->lomo();
		}

		function add_nashville($photo_path, $output) {
			try	{
			    $instagraph = Instagraph::factory($photo_path, $output);
			}
			catch (Exception $e) {
			    echo $e->getMessage();
			    die;
			}
			 
			$instagraph->nashville();
		}

		function edge_detect($photo_path, $output, $edge) {
			$this->add_magic($photo_path, $output, 'edge_detect', $edge);
		}

		function shade($photo_path, $output, $shade) {
			$this->add_magic($photo_path, $output, 'shade', $shade);
		}

		function double_channel($photo_path, $second_photo, $output, $channel = 'red', $size = '100%') {
			if ($this->is_photo($photo_path) && $this->is_photo($second_photo)) {
				$command = " convert -channel $channel $photo_path -flop $second_photo -resize ".$size." -fx \"(u+v)/2\" $output ";
				$this->cmd($command);
				if (file_exists($output)) {
					return $output;
				} else {
					return false;
				}
			}
		}

		function make_circled($photo_path, $output, $circle = '64,64 64,0') {
			if ($this->is_photo($photo_path)) {
				$command = "convert $photo_path ( +clone -threshold -1 -negate - fill white -draw \"circle ".$circle."\" )  -alpha off -compose copy_opacity -composite $output ";
				if (file_exists($output)) {
					return $output;
				} else {
					return false;
				}
			}
		}
	}

?>