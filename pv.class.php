<?php
/**
  *Project : PHP Vision (pVision) - (pv)
  *Version : 1.0
  *Start Time : 30.08.2010
  *Finish Time :
  *Founder : Ibrahim Halil SANDUVAC
  *Author/s : Ibrahim Halil SANDUVAC
  */

include "data_structs.php";
  
class dataStruct
{
	
	public function __construct()
	{
		
		//--- IMAGE TYPE CONSTANTS ---\\
		define("PV_GIF",IMAGETYPE_GIF);
		define("PV_JPEG",IMAGETYPE_JPEG);
		define("PV_JPG",IMAGETYPE_JPEG);
		define("PV_PNG",IMAGETYPE_PNG);
		define("PV_WBMP",IMAGETYPE_WBMP);
		define("PV_XBM",IMAGETYPE_XBM);
		
		//--- COLOR TYPE CONSTANTS ---\\
		define("PV_COLOR_RGB",1);
		define("PV_COLOR_GRAY",0);
		
		define("PV_AUTO",0);	//This constant find sth auto --- Ex. image type 
		
		define("PV_FILL",-1);	//This constant fill the object with color
		
		//--- ARC FILLED TYPE CONSTANTS ---\\
		define("PV_ARC_CHORD_FILL",-1);
		define("PV_ARC_CHORD_NOFILL",-2);
		define("PV_ARC_PIE",-3);
	}
	
	
	/**
	  *@function : getImageInfo - gets image info
	  *@access : public
	  *@param : String $image_file - image file
	  *@param : String $info - information - type,width,height
	  *@return : Integer type & Integer width & Integer height
	  */
	public function getImageInfo($image_file,$info)
	{
		if($info == "type")
			return exif_imagetype($image_file);
		elseif($info == "width" || $info == "height")
		{
			list($width,$height) = getimagesize($image_file);
			return $$info;
		}
	}// end of getImageInfo();
	
	
	/**
	  *DATA STRUCTURE
	  *@function : dataImage
	  *@access : protected
	  *@param : resource $image - image
	  *@param : Int $colorStyle=PV_COLOR_RGB - color style | PV_COLOR_RGB(1), PV_COLOR_GRAY(0)
	  *@param : Int $width - width
	  *@param : Int $height - height
	  *@return : PvImage (resource)image, (int)width, (int)height, (int)colorStyle
	  */
	public function dataImage($image, $colorStyle=PV_COLOR_RGB, $type=PV_AUTO, $width=PV_AUTO, $height=PV_AUTO)
	{
		if($width == 0)
			$width = $this->getImageInfo($image,"width");
		if($height == 0)
			$height = $this->getImageInfo($image,"height");
		if($type == 0)
			$type = $this->getImageInfo($image,"type");
		
		$img = new PvImage();
		$img->image = $image;
		$img->width = $width;
		$img->height = $height;
		$img->colorStyle = $colorStyle;
		$img->type = $type;
		$img->origin = $this->size(floor($width/2),floor($height/2));
		
		return $img;
	}//end of dataImage();
	
	
	/**
	  *DATA STRUCTURE
	  *@function : size
	  *@access : public
	  *@param : Int $width - width
	  *@param : Int $height - height
	  *@return : PvSize (int)width, (int)height
	  */
	public function size($width, $height)
	{
		$size = new PvSize();
		$size->width = $width;
		$size->height = $height;
		
		return $size;
	}//end of size();
	
	
	/**
	  *DATA STRUCTURE ALTERNATIVE
	  *@function : getSize
	  *@access : public
	  *@param : PvImage $image - image
	  *@return : PvSize (int)width, (int)height
	  */
	public function getSize($image)
	{
		$size = $this->size($image->width, $image->height);
		
		return $size;
	}//end of getSize()
	
	
	/**
	  *DATA STRUCTURE
	  *@function : point
	  *@access : public
	  *@param : Int $x - x coordinate
	  *@param : Int $y - y coordinate
	  *@return : PvPoint (int)x, (int)y
	  */
	public function point($x,$y)
	{
		$point = new PvPoint();
		$point->x = $x;
		$point->y = $y;
		
		return $point;
	}//end of point();
	
	/**
	  *DATA STRUCTURE
	  *@function : color
	  *@access : public
	  *@param : Int $r - red(max.255)
	  *@param : Int $g - green(max.255)
	  *@param : Int $b - blue(max.255)
	  *@param : Int $a=0 - alpha(max.177)
	  *@return : PvColor (int)r, (int)g, (int)b, (int)a
	  */
	public function color($r,$g,$b,$a=0)
	{
		$color = new PvColor;
		$color->r = $r;
		$color->g = $g;
		$color->b = $b;
		$color->a = $a;
		
		return $color;
	}//end of color()
	
	/**
	  *DATA STRUCTURE Alternative
	  *@function : colorAll - defines rgb as $colorAll
	  *@access : public
	  *@param : Int $colorAll - color(max.255)
	  *@param : Int $a=0 - alpha(max.177)
	  *@return : PvColor (int)r, (int)g, (int)b, (int)a
	  */
	public function colorAll($colorAll, $a=0)
	{
		$color = new PvColor;
		$color->r = $colorAll;
		$color->g = $colorAll;
		$color->b = $colorAll;
		$color->a = $a;
		
		return $color;
	}//end of colorAll()
	
	
	/**
	  *DATA STRUCTURE
	  *@function : pixel
	  *@access : public
	  *@param : PvPoint $point - pixel point
	  *@param : PvColor $color - pixel color
	  *@return : PvPixel (int)x, (int)y, (PvColor)color
	  */
	public function pixel($point,$color)
	{
		$pixel = new PvPixel;
		$pixel->x = $point->x;
		$pixel->y = $point->y;
		$pixel->color = $color;
		$pixel->gray = floor($color->r*0.2989 + $color->g*0.5870 + $color->b*0.1140);	//Gray algorithm
		
		return $pixel;
	}//end of pixel()
	
	
	/**
	  *DATA STRUCTURE
	  *@function : rect
	  *@access : public
	  *@param : PvPoint $point - rectangle point
	  *@param : PvSize $size - rectangle size
	  *@return : PvRect (int)x, (int)y, (PvColor)color
	  */
	public function rect($point, $size)
	{
		$rect = new PvRect;
		$rect->x = $point->x;
		$rect->y = $point->y;
		$rect->width = $size->width;
		$rect->height = $size->height;
		
		return $rect;
	}//end of rect()
	
}
 
  
  
class pv extends dataStruct
{
		
	/**
	  *@function : createImage - create image
	  *@access : public
	  *@param : PvSize $size - size(width,height)
	  *@param : Int $colorStyle=PV_COLOR_RGB - color style : PV_COLOR_RGB(1), PV_COLOR_GRAY(0)
	  *@param : Int $imageStyle=PV_JPG - image style
	  *@return : PvImage
	  */
	public function createImage($size, $colorStyle=PV_COLOR_RGB, $imageStyle=PV_JPG)
	{
		$img0 = imagecreatetruecolor($size->width, $size->height);
		
		$img = $this->dataImage($img0, $colorStyle, $imageStyle, $size->width, $size->height);
		
		$color = imagecolorallocate($img->image,0,0,0);
		
		imagefill($img->image,0,0,$color);
		
		return $img;
	}//end of createImage
	
	
	/**
	  *@function : loadImage - load an image
	  *@access : public
	  *@param : String $src - image source
	  *@param : PvSize $resize=PV_AUTO - size(width,height)
	  *@param : Int $colorStyle=PV_COLOR_RGB - color style : PV_COLOR_RGB(1), PV_COLOR_GRAY(0)
	  *@return : PvImage
	  */
	public function loadImage($src, $colorStyle=PV_COLOR_RGB)
	{
		$type = $this->getImageInfo($src,"type");
		$width = $this->getImageInfo($src,"width");
		$height = $this->getImageInfo($src,"height");
		
		if($type == PV_GIF)	
			$img = imagecreatefromgif($src);
		elseif($type == PV_JPG)
			$img = imagecreatefromjpeg($src);
		elseif($type == PV_PNG)
			$img = imagecreatefrompng($src);
		elseif($type == PV_WBMP)
			$img = imagecreatefromwbmp($src);
		elseif($type == PV_XBM)
			$img = imagecreatefromxbm($src);
		
		$img = $this->dataImage($img, $colorStyle, $type, $width, $height);
		
		if($colorStyle == PV_COLOR_GRAY)
		{
			$img = $this->convertGray($img);
		}
		
		return $img;
		
	
		
	}//end of loadImage();
	
	
	/**
	  *@function : convertGray - convert colors to gray sclae
	  *@access : public
	  *@param : PvImage $img
	  *@param : Int $colorValue=PV_COLOR_GRAY(0) - number between 0-100 0 is full grayscale
	  *@return : resource image
	  */
	public function convertGray($img,$colorValue=PV_COLOR_GRAY)
	{
		
		imagecopymergegray($img->image,$img->image,0,0,0,0,$img->width,$img->height,$colorValue);
		
		return $img;
		
	}//end of convertGray();
	
	
	/**
	  *@function : saveImage
	  *@access : public
	  *@param : PvImage $img
	  *@param : String $fileName
	  *@param : Int $quality=100 - Save Quality	//For JPEG and PNG
	  *@return : void
	  */
	public function saveImage($img,$fileName,$quality=100)
	{
		
		$type = $img->type;
		
		if($type == PV_GIF)
			imagegif($img->image, $fileName);
		elseif($type == PV_JPG)
			imagejpeg($img->image, $fileName, $quality);
		elseif($type == PV_PNG)
			imagepng($img->image, $fileName, $quality);
		elseif($type == PV_WBMP)
			imagewbmp($img->image, $fileName);
		elseif($type == PV_XBM)
			imagexbm($img->image, $fileName);
		
	}//end of saveImage();
	
	
	/**
	  *@function : showImage - show image in the browser
	  *@access : public
	  *@param : PvImage $img
	  *@return : void
	  */
	public function showImage($img)
	{
		$type = $img->type;
		
		if($type == PV_GIF)
		{
			header("Content-type: image/gif");
			imagegif($img->image);
		}
		elseif($type == PV_JPG)
		{
			header("Content-type: image/jpeg");
			imagejpeg($img->image);
		}
		elseif($type == PV_PNG)
		{
			header("Content-type: image/png");
			imagepng($img->image);
		}
		elseif($type == PV_WBMP)
		{
			header("Content-type: image/wbmp");
			imagewbmp($img->image);
		}
		elseif($type == PV_XBM)
		{
			header("Content-type: image/xbm");
			imagexbm($img->image);
		}
	}//end of showImage();
	
	
	/**
	  *@function : releaseImage
	  *@access : public
	  *@param : PvImage $image
	  *@return : void
	  */
	public function releaseImage($image)
	{
		imagedestroy($image->image);
	}//end of releaseImage()
	
	
	/**
	  *@function : showImage - show image in the browser
	  *@access : public
	  *@param : PvImage $img
	  *@param : PvSize $size
	  *@return : PvImage
	  */
	public function resize($img, $size)
	{
		$dst = $this->createImage($size,$img->colorStyle);
		
		imagecopyresized($dst->image, $img->image, 0, 0, 0, 0, $size->width, $size->height, $img->width, $img->height);
		
		$this->releaseImage($img);
		
		return $dst;
	}//end of resize();
	
	
	/**
	  *@function : zero - makes image black
	  *@access : public
	  *@param : PvImage $img
	  *@return : void
	  */
	public function zero($image)
	{
		$color = imagecolorallocate($image->image,0,0,0);
		
		imagefill($image->image,0,0,$color);
	}//end of zero()
	
	
	/**
	  *@function : locateColor - locating color on image & if image is gray convert color to gray
	  *@access : protected
	  *@param : PvImage $image
	  *@param : PvColor $color
	  *@return : locateColor
	  */
	public function locateColor($image, $color)
	{
		if($image->colorStyle != PV_COLOR_GRAY)
			$locateColor = imagecolorallocatealpha($image->image, $color->r, $color->g, $color->b, $color->a);
		else
		{
			$roundedColor = round(($color->r+$color->g+$color->b)/3);
			$locateColor = imagecolorallocatealpha($image->image, $roundedColor, $roundedColor, $roundedColor, $color->a);
		}
		
		return $locateColor;
	}//end of locateColor()
	
	
	
	/**
	  *DRAW FUNCTIONS
	  */
	
	
	/**
	  *@function : line - draws a line
	  *@access : public
	  *@param : PvImage $image - image
	  *@param : PvPoint $pt1 - 1.point
	  *@param : PvPoint $pt2 - 2.point
	  *@param : PvColor $color - line color
	  *@param : Int $thickness=1 - line thickness
	  *@return : void()
	  */
	public function line($image, $pt1, $pt2, $color, $thickness=1)
	{
		$color = $this->locateColor($image, $color);
		
		imageline($image->image,$pt1->x, $pt1->y, $pt2->x, $pt2->y, $color);
		
		if($thickness != 1)	//For thickness
		{
			
			if($thickness%2 != 0)	//If it is odd
				$lineCount = $thickness-1;
			else					//If it is even
			{
				$lineCount = $thickness-2;
				imageline($image->image, $pt1->x, $pt1->y+($lineCount/2)+1, $pt2->x, $pt2->y+($lineCount/2)+1, $color);
			}
			
			//Draw upper lines
			for($i = 1; $i <= $lineCount/2; $i++)
			{
				imageline($image->image, $pt1->x, $pt1->y-$i, $pt2->x, $pt2->y-$i, $color);
			}	
			
			//Draw under lines
			for($j = 1; $j <= $lineCount/2; $j++)
			{
				imageline($image->image, $pt1->x, $pt1->y+$j, $pt2->x, $pt2->y+$j, $color);
			}
			
		}
		
	}//end of line()
	
	
	/**
	  *@function : rectangle - draws a rectangle
	  *@access : public
	  *@param : PvImage $image - image
	  *@param : PvPoint $pt1 - 1.point
	  *@param : PvPoint $pt2 - 2.point
	  *@param : PvColor $color - rectangle color
	  *@param : Int $thickness=1 - rectangle thickness & you can set PV_FILL to fill the rectangle
	  *@return : void()
	  */
	public function rectangle($image, $pt1, $pt2, $color, $thickness=1)
	{
		$color = $this->locateColor($image,$color);
		
		if($thickness == PV_FILL)
			imagefilledrectangle($image->image, $pt1->x, $pt1->y, $pt2->x, $pt2->y, $color);
		else
		{
			imagerectangle($image->image, $pt1->x, $pt1->y, $pt2->x, $pt2->y, $color);
			
			if($thickness != 1)
			{
				for($i = 1; $i <= $thickness-1; $i++)
				{
					imagerectangle($image->image, $pt1->x-$i, $pt1->y-$i, $pt2->x+$i, $pt2->y+$i, $color);
				}	
			}
		}
	}//end of rectangle()
	
	
	/**
	  *@function : circle - draws a circle
	  *@access : public
	  *@param : PvImage $image - image
	  *@param : PvPoint $center - circle center point
	  *@param : Int radius - circle radius
	  *@param : PvColor $color - circle color
	  *@param : Int $thickness=1 - circle thickness & you can set PV_FILL to fill the circle
	  *@return : void()
	  */
	public function circle($image, $center, $radius, $color, $thickness=1)
	{
		$color = $this->locateColor($image,$color);
		
		if($thickness == PV_FILL)
			imagefilledellipse($image->image,$center->x,$center->y,$radius,$radius,$color);
		else
		{
			imageellipse($image->image,$center->x,$center->y,$radius,$radius,$color);
			
			if($thickness != 1)
			{
				for($i = 1; $i <= $thickness-1; $i++)
				{
					imageellipse($image->image,$center->x,$center->y,$radius+$i,$radius+$i,$color);
				}
			}	
		}
	}//end of circle()
	
	
	/**
	  *@function : ellipse - draws a ellipse
	  *@access : public
	  *@param : PvImage $image - image
	  *@param : PvPoint $center - ellipse center point
	  *@param : PvSize $size - ellipse size(width,height)
	  *@param : PvColor $color - ellipse color
	  *@param : Int $thickness=1 - ellipse thickness & you can set PV_FILL to fill the ellipse
	  *@return : void()
	  */
	public function ellipse($image, $center, $size, $color, $thickness=1)
	{
		$color = $this->locateColor($image,$color);
		
		if($thickness == PV_FILL)
			imagefilledellipse($image->image,$center->x,$center->y,$size->width,$size->height,$color);
		else
		{
			imageellipse($image->image,$center->x,$center->y,$size->width,$size->height,$color);
			
			if($thickness != 1)
			{
				for($i = 1; $i <= $thickness-1; $i++)
				{
					imageellipse($image->image,$center->x,$center->y,$size->width+$i,$size->height+$i,$color);
				}
			}
		}
	}//end of ellipse()
	
	
	/**
	  *@function : arc - draws an arc
	  *@access : public
	  *@param : PvImage $image - image
	  *@param : PvPoint $center - arc center point
	  *@param : PvSize $size - arc size(width,height)
	  *@param : Int $start_angle - start angle(degree)	anti-clock wise
	  *@param : Int $end_angle - end angle(degree)		anti-clock wise
	  *@param : PvColor $color - arc color
	  *@param : Int $thickness=1 - arc thickness & you can set pVision ARC fill types
	  *@return : void()
	  */
	public function arc($image, $center, $size, $start_angle, $end_angle, $color, $thickness=1)
	{
		$color = $this->locateColor($image,$color);
		$start_angle = 360 - $start_angle;
		$end_angle = 360 - $end_angle;
		
		if($thickness > 0)
		{
			imagearc($image->image,$center->x,$center->y,$size->width,$size->height,$end_angle, $start_angle,$color);
			
			if($thickness != 1)
			{
				for($i = 1; $i <= $thickness-1; $i++)
				{
					imagearc($image->image, $center->x, $center->y, $size->width+$i, $size->height+$i, $end_angle, $start_angle, $color);
				}	
			}
		}
		elseif($thickness < 0)
		{
			if($thickness == PV_ARC_CHORD_FILL)
			{
				imagefilledarc($image->image, $center->x, $center->y, $size->width, $size->height, $end_angle, $start_angle, $color, IMG_ARC_CHORD);
			}
			elseif($thickness == PV_ARC_CHORD_NOFILL)
			{
				imagefilledarc($image->image, $center->x, $center->y, $size->width, $size->height, $end_angle, $start_angle, $color, IMG_ARC_NOFILL);
			}
			elseif($thickness == PV_ARC_PIE)
			{
				imagefilledarc($image->image, $center->x, $center->y, $size->width, $size->height, $end_angle, $start_angle, $color, IMG_ARC_PIE);
			}
		}
	}//end of arc()
	
	
	/**
	  *@function : polygon
	  *@access : public
	  *@param : PvImage $image - image
	  *@param : Array(PvPoint) $points - points of polygon's vertices --- array(PvPoint $pt1(x,y), PvPoint $pt2(x,y), PvPoint $pt3(x,y), ...)
	  *@param : PvColor $color - polygon color
	  *@param : Int $fill=0 - fill type & you can also set PV_FILL
	  *@return : void()
	  */
	public function polygon($image, $points, $color, $fill=0)
	{
		$color = $this->locateColor($image,$color);
		$verticesCount = count($points);
		$pointArray = array();
		
		foreach($points as $pts)
		{
			array_push($pointArray,$pts->x);
			array_push($pointArray,$pts->y);
		}
		
		if($fill == 0)
		{
			imagepolygon($image->image, $pointArray, $verticesCount, $color);
		}
		elseif($fill == PV_FILL)
		{
			imagefilledpolygon($image->image, $pointArray, $verticesCount, $color);
		}
	}//end of polygon()
	
	
	/**
	  * PIXEL FUNCTIONS
	  */
	
	
	/**
	  *@function : getPixel
	  *@access : public
	  *@param : PvImage $image - image
	  *@param : Int $type=PV_COLOR_RGB - pixel color type
	  *@param : PvPoint $point - points
	  *@return : PvPixel
	  */
	public function getPixel($image, $point)
	{
	
			$colors = imagecolorsforindex($image->image,imagecolorat($image->image,$point->x,$point->y));
		
			$color = $this->color($colors["red"],$colors["green"],$colors["blue"],$colors["alpha"]);
		
		
		$pixel = $this->pixel($point,$color);
		
		return $pixel;
	}//end of getPixel()
	
	
	/**
	  *@function : setPixel
	  *@access : public
	  *@param : PvImage $image - image
	  *@param : PvPixel $pixel - pixel
	  *@param : PvColor $color - pixel's new color
	  *@return : void
	  */
	public function setPixel($image, $pixel, $color)
	{
		$color = $this->locateColor($image,$color);
		
		imagesetpixel($image->image, $pixel->x, $pixel->y, $color);		
	}//end of setPixel()
	
	
	/**
	  *@function : image2array - compute all pixel color value and write to an 3D array
	  *@access : protected
	  *@param : PvImage $image - image
	  *@param : Int $type=PV_COLOR_RGB
	  *@return : Array
	  */
	public function image2array($image)
	{
		$width = $image->width;
		$height = $image->height;
		
		$pixelArr = array();
		
		for($w = 0; $w < $width; $w++)
		{
			for($h = 0; $h < $height; $h++)
			{
				$pixelColor = $this->getPixel($image, $this->point($w,$h))->color;
				
				$pixelArr[$w][$h] =  $pixelColor;
			}
		}
		
		return $pixelArr;
	}//end of image2array
	
	
	/**
	  * ROI(Region of Interest) FUNCTIONS
	  */
	  
	
	/**
	  *@function : getROI - return an area(rectangle) from image
	  *@access : public
	  *@param : PvImage $image - image
	  *@param : PvRect $rect - ROI(Region of Interest)
	  *@return : PvImage
	  */
	public function getROI($image, $rect)
	{
		$dst = $this->createImage($this->size($rect->width, $rect->height), $image->colorStyle);
		
		imagecopyresampled($dst->image, $image->image, 0, 0, $rect->x, $rect->y, $rect->width, $rect->height, $rect->width, $rect->height);
		
		return $dst;
	}//end of getROI()
	
	
	/**
	  *@function : addROI - add an area to image
	  *@access : public
	  *@param : PvImage $image - image
	  *@param : PvImage $add_image - add image
	  *@param : PvRect $rect - ROI(Region of Interest)
	  *@return : void
	  */
	public function addROI($image, $add_image, $rect)
	{
		imagecopyresized($image->image, $add_image->image, $rect->x, $rect->y, 0, 0, $rect->width, $rect->height, $add_image->width, $add_image->height);
	}//end of setROI()
	  
	
	/**
	  *@function : setImageROI - set an area(rectangle) for processing
	  *@access : public
	  *@param : PvImage $image - image
	  *@param : PvRect $rect - ROI(Region of Interest)
	  *@return : void
	  */
	public function setImageROI($image, $rect)
	{
		$image->ROI = $rect;
		$image->all_ROI = $image->image;
		$image->image = $this->getROI($image, $rect)->image;
		
		//return $image->all_ROI;
	}//end of setImageROI()
	
	
	/**
	  *@function : resetImageROI - reset image ROI which is defined by setImageROI - and also it means add ROI which is processed from setImageROI() to resetImageROI()
	  *@access : public
	  *@param : PvImage $image
	  *@return : void
	  */
	public function resetImageROI($image)
	{
		imagecopyresized($image->all_ROI, $image->image, $image->ROI->x, $image->ROI->y, 0, 0, $image->ROI->width, $image->ROI->height, $image->ROI->width, $image->ROI->height);
		
		$image->image = $image->all_ROI;

	}//end of resetImageROI()
	  
	
	/**
	  * IMAGE OPERATIONS
	  */
	
	
	/**
	  *@function : absVal - compute the absolute values
	  *@access : public
	  *@param : PvImage $src - image
	  *@param : PvImage $dst - destination image
	  *@return : void
	  */
	public function absVal($src, $dst)
	{
		$dst = $this->convertGray($src);
	}//end of absVal
	
	
	
	/**
	  *@function : absDiff - compute the absolute values between 2 images differences	--- For 2 images which are 1024x768 takes 34 seconds
	  *@access : public
	  *@param : PvImage $src1 - first image
	  *@param : PvImage $src2 - second image
	  *@param : PvImage $dst - result destination image
	  *@return : void
	  */
	public function absDiff($src1, $src2, $dst)
	{
		$this->absVal($src1,$src1);
		$this->absVal($src2,$src2);
		
		if($src1->width == $src2->width && $src1->height == $src2->height)
		{
			$width = $src1->width;
			$height = $src1->height;
			
			for($x = 0; $x < $width; $x++)
			{
				for($y = 0; $y < $height; $y++)
				{
					$f = $this->getPixel($src1,$this->point($x,$y));	//First Pixel
					$s = $this->getPixel($src2,$this->point($x,$y));	//Second Pixel
					
					$result = abs($f->gray - $s->gray);
					
					$this->setPixel($dst, $f, $this->colorAll($result));
				}
			}	
		}
	}
	
	
}


?>