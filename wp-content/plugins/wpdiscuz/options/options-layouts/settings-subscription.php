<?php
if (!defined('ABSPATH')) {
    exit();
}
?>
<div>
    <h2 class="wpd-subtitle"><?php _e('Email Subscription Settings', 'wpdiscuz'); ?> </h2>
    <table class="wp-list-table widefat plugins wpdxb" style="margin-top:10px; border:none;">
        <tbody>
            <tr valign="top">
                <th scope="row"><label for="isNotifyOnCommentApprove"><?php _e('Notify comment author once comment is approved', 'wpdiscuz'); ?></label></th>
                <td><input type="checkbox" <?php checked($this->optionsSerialized->isNotifyOnCommentApprove == 1) ?> value="1" name="isNotifyOnCommentApprove" id="isNotifyOnCommentApprove" /><label for="isNotifyOnCommentApprove"></label></td>
            </tr>
            <tr valign="top">
                <th scope="row" style="width:50%;">
                    <label for="wc_disable_member_confirm"><?php _e('Disable subscription confirmation for registered users', 'wpdiscuz'); ?></label>
                </th>
                <td>
                    <input type="checkbox" <?php checked($this->optionsSerialized->disableMemberConfirm == 1) ?> value="1" name="wc_disable_member_confirm" id="wc_disable_member_confirm" />
                    <label for="wc_disable_member_confirm"></label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label for="disableGuestsConfirm"><?php _e('Disable subscription confirmation for guests', 'wpdiscuz'); ?></label>
                </th>
                <td>
                    <input type="checkbox" <?php checked($this->optionsSerialized->disableGuestsConfirm == 1) ?> value="1" name="disableGuestsConfirm" id="disableGuestsConfirm" />
                    <label for="disableGuestsConfirm"></label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label><?php _e('Show subscription types in dropdown', 'wpdiscuz'); ?></label>
                </th>
                <th>
                    <fieldset>
                        <?php $subscriptionType = isset($this->optionsSerialized->subscriptionType) ? $this->optionsSerialized->subscriptionType : 1; ?>
                        <label>
                            <input type="radio" value="2" <?php checked(2 == $subscriptionType); ?> name="subscriptionType" id="subscriptionTypePost" /> 
                            <span><?php _e('Subscribe to all comments of this post', 'wpdiscuz') ?></span>
                        </label><br>    
                        <label>
                            <input type="radio" value="3" <?php checked(3 == $subscriptionType); ?> name="subscriptionType" id="subscriptionTypeAllComments" /> 
                            <span><?php _e('Subscribe to all replies to my comments ', 'wpdiscuz') ?></span>
                        </label><br/>
                        <label title="<?php _e('Both', 'wpdiscuz') ?>">
                            <input type="radio" value="1" <?php checked(1 == $subscriptionType); ?> name="subscriptionType" id="subscriptionTypeBoth" />
                            <span><?php _e('Both', 'wpdiscuz') ?></span>
                        </label>
                        &nbsp;<br/>
                    </fieldset>
                </th>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label for="wc_show_hide_reply_checkbox"><?php _e('Show "Notify of new replies to this comment"', 'wpdiscuz'); ?></label>
                    <p class="wpd-desc">
                        <?php _e('wpDiscuz is the only comment plugin which allows you to subscribe to certain comment replies. This option is located above [Post Comment] button in comment form. You can disable this subscription way by unchecking this option.', 'wpdiscuz') ?>
                    </p>                    
                </th>
                <td>
                    <input type="checkbox" <?php checked($this->optionsSerialized->showHideReplyCheckbox == 1) ?> value="1" name="wc_show_hide_reply_checkbox" id="wc_show_hide_reply_checkbox" />
                    <label for="wc_show_hide_reply_checkbox"></label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label for="isReplyDefaultChecked"><?php _e('"Notify of new replies to this comment" checked by default', 'wpdiscuz'); ?></label>
                </th>
                <td>
                    <input type="checkbox" <?php checked($this->optionsSerialized->isReplyDefaultChecked == 1) ?> value="1" name="isReplyDefaultChecked" id="isReplyDefaultChecked" />
                    <label for="isReplyDefaultChecked"></label>
                </td>
            </tr>
            <?php if (class_exists('Prompt_Comment_Form_Handling')) { ?>
                <tr valign="top">
                    <th scope="row">
                        <label for="wc_use_postmatic_for_comment_notification"><?php _e('Use Postmatic for subscriptions and commenting by email', 'wpdiscuz'); ?></label>
                        <p class="wpd-desc"><?php _e('Postmatic allows your users subscribe to comments. Instead of just being notified, they add a reply right from their inbox.', 'wpdiscuz'); ?></p>
                    </th>
                    <td>
                        <input type="checkbox" <?php checked($this->optionsSerialized->usePostmaticForCommentNotification == 1) ?> value="1" name="wc_use_postmatic_for_comment_notification" id="wc_use_postmatic_for_comment_notification" />
                        <label for="wc_use_postmatic_for_comment_notification"></label>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>