<?php

  /**
    *@data structure: PvImage - image data structure
    *@param public Resource $image - image
    *@param public Int $width - image width
    *@param public Int $height - image height
    *@param public Int $colorStyle(CONSTANT) - image color style
    *@param public Int $type(CONSTANT) - image type
    *@param public PvPoint $origin - image origin point
	*@param protected PvImage $all_ROI - main image for setImageROI() and resetImageROI() functions
	*@param protected PvRect $ROI - rectangle of image for setImageROI() and resetImageROI() functions
    */
	class PvImage
	{
		public $image,
			   $width,
			   $height,
			   $colorStyle,
			   $type,
			   $origin,
			   $all_ROI,
			   $ROI;
	}


  /**
    *@data structure: PvSize - size data structure
    *@param public Int $width - width
    *@param public Int $height - height
    */
	class PvSize
	{
		public $width,
			   $height;
	}


  /**
    *@data structure: PvPoint - point data structure
    *@param public Int $x - x 
    *@param public Int $y - y
    */
	class PvPoint
	{
		public $x,
			   $y;	
	}


  /**
    *@data structure: PvColor - color data structure
    *@param public Int $r - red (max.255)
    *@param public Int $g - green (max.255)
    *@param public Int $b - blue (max.255)
   	*@param public Int $a - alpha (max.177)
   	*/
	class PvColor
	{
		public $r,
			   $g,
			   $b,
			   $a;
	}


  /**
    *@data structure: PvPixel - pixel data structure
    *@param public Int $x - pixel x point
    *@param public Int $y - pixel y point
    *@param public PvColor $color - pixel color
	*@param public Int $gray - pixel gray color
    */
	class PvPixel
	{
		public $x,
			   $y,
			   $color,
			   $gray;	
	}


  /**
    *@data structure: PvRect - rectangle data structure. It indicates a invisible rectangle from image.
    *@param public Int $x - rectangle x point
    *@param public Int $y - rectangle y point
    *@param public Int $width - rectangle width
	*@param public Int $height - rectangle height
    */
	class PvRect
	{
		public $x,
			   $y,
			   $width,
			   $height;	
	}

?>