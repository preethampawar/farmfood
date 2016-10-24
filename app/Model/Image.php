<?php
App::uses('AppModel', 'Model');
class Image extends AppModel
{
	var $name = 'Image';	
	var $belongsTo = array('Product', 'Category');
	
	public $imgPath = 'img/images/';
	public $cachePath = 'img/imagecache/';
	
	function saveImageFile($params, $caption='')
	{
		$image['Image']['id'] = null;
		$image['Image']['caption'] = $caption;
		$image['Image']['type'] = $params['type'];
		$image['Image']['extension'] = $this->getFileExtension($params['name']);
		if($this->save($image))
		{
			$imageInfo = $this->read();
			$filename = $imageInfo['Image']['id'];
			if(move_uploaded_file($params['tmp_name'], $this->imgPath.$filename))
			{				
				return $filename;
			}
			else
			{
				$this->delete($filename);
			}
		}
		return false;
	}
	
	function getFileExtension($filename)
	{
		return substr($filename, strrpos($filename, '.'));
	}
	
	/**
	 * Check if image file is a actual image or fake image
	 */
	function isValidImageFile($image) {
		$check = getimagesize($image["tmp_name"]);
		
		if(!empty($check)) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Function to check valid image type
	 */
	function isValidImageType($image) {
		if($image['type'] != "image/jpeg" && $image['type'] != "image/png") {
			return false;
		} else {
			return true;
		}		
	}
	
	/**
	 * Function to check valid image size
	 */
	function isValidImageSize($image) {
		$imgSize = $image['size'];
		if($imgSize > 0) {
			$maxSize = 6;
			if(ceil($imgSize/(1024*1024)) > $maxSize) {
				return false;
			}
			else {
				return true;
			}
		}
		return false;
	}
	
	/**
	 * Function to delete image by id
	 */
	function deleteImage($imageID) {
		// remove from images cache folder
		$imageCachePath = 'img/imagecache/';
		App::uses('Folder', 'Utility');
		App::uses('File', 'Utility');
		$imgCacheDir = new Folder();		
				
		$imgCacheDir->path = $imageCachePath;
		$files = $imgCacheDir->find($imageID.'_.*');
		if(!empty($files)) {
			foreach($files as $file) {
				$cacheFilePath = $imageCachePath.$file;
				$file = new File($cacheFilePath);
				$file->delete();							
			}
		}
		
		// remove from images folder
		$imagePath = 'img/images/'.$imageID;
		$file = new File($imagePath);
		$file->delete();

		// remove from images table	
		App::uses('Image', 'Model');
		$this->Image = new Image;
		$this->Image->delete($imageID);
		return true;
	}
}
?>