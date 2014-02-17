<?php
/*
Plugin Name: ytbd Message Box
Plugin URI: http:yotsuba-d.com
Description: ウィジェットにシンプルなメッセージボックスを追加できます。
Version: 1.0
Author: kenji goto
Author URI: http://yotsuba-d.com
License: GPL
*/
?>
<?php
class YTBmessagewidget extends WP_Widget {
    function YTBmessagewidget() {
        parent::WP_Widget(false, $name = 'メッセージボックス' );
    }
    function widget($args, $instance) {
        extract( $args );
        $messagebody = apply_filters( 'widget_messagebody', $instance['wdmessagebody'] );
        $messagecolor = apply_filters( 'widget_messagecolor', $instance['wdmessagecolor'] );
        $messagebackgroundcolor = apply_filters( 'widget_messagebackgroundcolor', $instance['wdmessagebackgroundcolor'] );
        $messagepadding = apply_filters( 'widget_messagepadding', $instance['wdmessagepadding'] );
        $messagemargin = apply_filters( 'widget_messagemargin', $instance['wdmessagemargin'] );
        $messagestyle = apply_filters( 'widget_messagestyle', $instance['wdmessagestyle'] );
        ?>
        <?php echo '<div class="widget" style="background-color:' . $messagebackgroundcolor .'; color:' . $messagecolor .'; padding:' . $messagepadding .'; margin:' . $messagemargin .'; ' . $messagestyle .'">'.$messagebody. '</div>'; ?>
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance = $new_instance;
        $instance['wdmessagebody'] = stripslashes($new_instance['wdmessagebody']);
        $instance['wdmessagecolor'] = trim($new_instance['wdmessagecolor']);
        $instance['wdmessagebackgroundcolor'] = trim($new_instance['wdmessagebackgroundcolor']);
        $instance['wdmessagepadding'] = trim($new_instance['wdmessagepadding']);
        $instance['wdmessagemargin'] = trim($new_instance['wdmessagemargin']);
        $instance['wdmessagestyle'] = trim($new_instance['wdmessagestyle']);
            return $instance;
        }
    function form($instance) {
        $messagebody =  htmlspecialchars($instance['wdmessagebody']);
        $messagecolor =  htmlspecialchars($instance['wdmessagecolor']);
        $messagebackgroundcolor =  htmlspecialchars($instance['wdmessagebackgroundcolor']);
        $messagepadding =  htmlspecialchars($instance['wdmessagepadding']);
        $messagemargin =  htmlspecialchars($instance['wdmessagemargin']);
        $messagestyle =  htmlspecialchars($instance['wdmessagestyle']);
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <?php _e('<div style="margin:20px 0; background-color:#f4f3e4; padding:10px; ">'); ?>
        <?php echo '<div class="widget" style="background-color:' . $messagebackgroundcolor .'; color:' . $messagecolor .'; padding:' . $messagepadding .'; margin:' . $messagemargin .'; ' . $messagestyle .'">メッセージはこのように表示されます。</div>'; ?>

        <p>
           <label for="<?php echo $this->get_field_id('wdmessagebody'); ?>">
             <?php _e('<strong>メッセージ</strong>'); ?>
           </label>
           <textarea class="widefat" type="text" id="<?php echo $this->get_field_id('wdmessagebody'); ?>" name="<?php echo $this->get_field_name('wdmessagebody'); ?>" value="<?php echo ($messagebody); ?>"><?php echo ($messagebody); ?></textarea>
           <?php _e('<span style="font-size:10px;">リンクを入れたい場合　例：&lt;a href=&quot;リンク先のURL&quot;&gt;リンクされるテキスト&lt;/a&gt;</span>'); ?>
        </p>
                <p>
           <label for="<?php echo $this->get_field_id('wdmessagebackgroundcolor'); ?>">
             <?php _e('<strong>背景色</strong>'); ?>
           </label>
           <input class="widefat" type="text" id="<?php echo $this->get_field_id('wdmessagebackgroundcolor'); ?>" name="<?php echo $this->get_field_name('wdmessagebackgroundcolor'); ?>"  value="<?php echo ($messagebackgroundcolor); ?>" ></input>
           <?php _e('<span style="font-size:10px;">例：#f00 （赤い背景） black (黒い背景）</span>'); ?>
        </p>

        <p>
           <label for="<?php echo $this->get_field_id('wdmessagecolor'); ?>">
             <?php _e('<strong">文字色</strong>'); ?>
           </label>
           <input class="widefat" type="text" id="<?php echo $this->get_field_id('wdmessagecolor'); ?>" name="<?php echo $this->get_field_name('wdmessagecolor'); ?>"  value="<?php echo ($messagecolor); ?>" ></input>
            <?php _e('<span style="font-size:10px;">例：#fff （白い文字） black (黒い文字）</span>'); ?>
        </p>


        <p>
           <label for="<?php echo $this->get_field_id('wdmessagepadding'); ?>">
             <?php _e('<strong>囲いの内側の余白</strong>（padding)'); ?>
           </label>
           <input class="widefat" type="text" id="<?php echo $this->get_field_id('wdmessagepadding'); ?>" name="<?php echo $this->get_field_name('wdmessagepadding'); ?>"  value="<?php echo ($messagepadding); ?>" </input>        
           <?php _e('<span style="font-size:10px;">例：15px （上下左右10px） 20px 0 (上下に20px　横は無し）<br />※背景色を入れた場合は内側の余白を設定しましょう。</span>'); ?>
        </p>
        <?php _e('</div><div style="margin:20px 0; padding:10px; ">'); ?>
        <p>
           <label for="<?php echo $this->get_field_id('wdmessagemargin'); ?>">
             <?php _e('<strong>囲いの外側の余白</strong>(margin）'); ?>
           </label>
           <input class="widefat" type="text" id="<?php echo $this->get_field_id('wdmessagemargin'); ?>" name="<?php echo $this->get_field_name('wdmessagemargin'); ?>"  value="<?php echo ($messagemargin); ?>" ></input>        
           <?php _e('<span style="font-size:10px;">例：10px （上下左右10px） 30px 0 20px 0 (上に30px、下に20px 横は無し）</span>'); ?>
        </p>
        <p>
           <label for="<?php echo $this->get_field_id('wdmessagestyle'); ?>">
             <?php _e('<strong>スタイル追加</strong>'); ?>
           </label>
           <input class="widefat" type="text" id="<?php echo $this->get_field_id('wdmessagestyle'); ?>" name="<?php echo $this->get_field_name('wdmessagestyle'); ?>"  value="<?php echo ($messagestyle); ?>" ></input>        
           <?php _e('<span style="font-size:10px;">例：border:#f00 1px dotted; （赤い点線で囲う） border-radius:10px; (10pxの角丸にする）<br />　　font-size:3em; （文字を大きくする）</span>'); ?>
        </p>
        <?php _e('</div>'); ?>

        <?php
    }
}
add_action('widgets_init', create_function('', 'return register_widget("YTBmessagewidget");'));
?>