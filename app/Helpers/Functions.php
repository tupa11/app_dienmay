<?php
namespace App\Helpers;

use App\Models\Image;

class Functions {

	public static function uploadImg(){
		ob_start();
        $images = Image::orderBy('id', 'DESC')->take(30)->get();

		?>
		<!-- Upload Image -->
        <div id="uploadModal" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 1024px; padding: 0px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><?php echo  __('form.image_gallery') ?></h4>
                    </div>
                    <div class="modal-body">
                    	<ul class="nav nav-tabs">
						    <li class="upload-files active"><a data-toggle="tab" href="#home"><?php echo __('form.upload_files') ?></a></li>
						    <li class="library-img"><a data-toggle="tab" href="#library"><?php echo __('form.media_library') ?></a></li>
						</ul>
                        <div class="tab-content" style="margin-top: 50px;position: relative;"> 
						    <div id="home" class="tab-pane fade in active" style="width: 100%;">
						      	<div id="fileuploader"></div>
                                <table id="url">
                                    <tr>
                                        <td colspan="2"><h4><?php echo  __('product.upload_from_url') ?></h4></td>
                                    </tr>
                                    <tr>
                                        <td><label><?php echo __('table.image_url') ?></label></td>
                                        <td><input type="text" id="url-upload" size="35"></td>
                                    </tr>
                                    <tr>
                                        <td><label><?php echo __('table.image_title') ?></label></td>
                                        <td><input type="text" id="url-title" size="35"></td>
                                    </tr>
                                    <tr>
                                        <td><label><?php echo __('table.image_alt') ?></label></td>
                                        <td><input type="text" id="url-alt" size="35"></td>
                                    </tr>
                                </table>
                                <div class="modal-h">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="cancel_model"><?php echo  __('form.start_upload') ?></button>
                                </div>
						    </div>
						    <div id="library" class="tab-pane fade" style="height: 540px;">
                                <div class="wrap-loading-icon show_img"><div class="lds-dual-ring"></div></div><input type="text" placeholder="<?php echo __('form_search_images_by_name') ?>" class="search_images">
                                <div class="wrap-library" style="overflow-y: scroll;max-height: 500px;">
                                    <?php
                                    if(count($images) > 0){
                                        foreach ($images as $item) {
                                    ?>      
        						      	<div data-title='<?php echo $item->title ?>' data-alt='<?php echo $item->alt ?>' data-id="<?php echo $item->id; ?>" data-src="<?php echo asset('uploads').'/'.$item->path.'/'.$item->name ?>"  class='image-item' style="position: relative;">
                                            <div class="wrap-check-icon">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <img class="lazy-image" src="<?php echo asset('uploads').'/'.$item->path.'/'.$item->name ?>"/>
                                        </div>
                                            
    						      	<?php
                                        }
                                    } 
                                    ?>
                                    <div class="wrap-loading-icon"><div class="lds-dual-ring"></div></div>
                                </div>
                                <div class="modal-f">
                                    <button type="button" disabled="disabled" class="btn btn-primary" data-dismiss="modal" id="inset_image"><?php echo  __('form.insert_into_page') ?></button>
                                </div>
						    </div>
                            <span style="display: none;" class="img_name"></span>
						 </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- End upload image -->
   
		<?php
		return ob_get_clean();		
	}
	

	/**
     *
     * insert and update data
     *
     * @param status: insert or update, table name, id record if status is update , data is array(column,value)
     *
     *
     */
    public static function insertUpdate($status = '', $table = '', $id = '', $datas = array()) {
        if ($status) {
            if ($status == 'insert' && $datas && $table) {
                foreach ($datas as $name => $value) {
                    $table->$name = $value;
                }
                $table->save();
            } else if ($status == 'update' && $datas && $table) {
                $table::where($table->getKeyName(), $id)->update($datas);
            }
            return $table->id;
        }
    }

}