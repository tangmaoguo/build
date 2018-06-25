<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!-- 代码1：放在页面需要展示的位置  -->
<!-- 如果您配置过sourceid，建议在div标签中配置sourceid、cid(分类id)，没有请忽略  -->
<div id="cyReward" role="cylabs" data-use="reward" style="text-align:center;"></div>
<!-- 代码2：用来读取评论框配置，此代码需放置在代码1之后。 -->
<!-- 如果当前页面有评论框，代码2请勿放置在评论框代码之前。 -->
<!-- 如果页面同时使用多个实验室项目，以下代码只需要引入一次，只配置上面的div标签即可 -->
<script type="text/javascript" charset="utf-8" src="https://changyan.itc.cn/js/lib/jquery.js"></script>
<script type="text/javascript" charset="utf-8" src="https://changyan.sohu.com/js/changyan.labs.https.js?appid=cytEt3nmb"></script>
<div id="comments">
    <?php $config=Helper::options()->plugin('HelloChangYan'); ?>
    <?php if($config->isOpenComment==0): ?>
  	此文章共有<a href="#SOHUCS" id="changyan_count_unit"></a>条评论，
	<a href="#SOHUCS" id="changyan_parti_unit"></a>人参与
    <div id="SOHUCS" sid="<?php echo $this->cid;echo $this->date('ymdhis')?>" ></div>
	<script type="text/javascript" src="https://assets.changyan.sohu.com/upload/plugins/plugins.count.js"></script>
    <script charset="utf-8" type="text/javascript" src="https://changyan.sohu.com/upload/changyan.js" ></script>
    <script type="text/javascript">
        window.changyan.api.config({
            appid: '<?php echo $config->appid?>',
            conf: '<?php echo $config->appkey?>'
        });
    </script>
    <?php else: ?>
        <?php $this->comments()->to($comments); ?>
    <?php if ($comments->have()): ?>
	<h3><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></h3>
    
    <?php $comments->listComments(); ?>

    <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
    
    <?php endif; ?>

    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond">
        <div class="cancel-comment-reply">
        <?php $comments->cancelReply(); ?>
        </div>
    
    	<h3 id="response"><?php _e('添加新评论'); ?></h3>
    	<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
            <?php if($this->user->hasLogin()): ?>
    		<p><?php _e('登录身份: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></p>
            <?php else: ?>
    		<p>
                <label for="author" class="required"><?php _e('称呼'); ?></label>
    			<input type="text" name="author" id="author" class="text" value="<?php $this->remember('author'); ?>" required />
    		</p>
    		<p>
                <label for="mail"<?php if ($this->options->commentsRequireMail): ?> class="required"<?php endif; ?>><?php _e('Email'); ?></label>
    			<input type="email" name="mail" id="mail" class="text" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
    		</p>
    		<p>
                <label for="url"<?php if ($this->options->commentsRequireURL): ?> class="required"<?php endif; ?>><?php _e('网站'); ?></label>
    			<input type="url" name="url" id="url" class="text" placeholder="<?php _e('http://'); ?>" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
    		</p>
            <?php endif; ?>
    		<p>
                <label for="textarea" class="required"><?php _e('内容'); ?></label>
                <textarea rows="8" cols="50" name="text" id="textarea" class="textarea" required ><?php $this->remember('text'); ?></textarea>
            </p>
    		<p>
                <button type="submit" class="submit"><?php _e('提交评论'); ?></button>
            </p>
    	</form>
    </div>
    <?php else: ?>
    <h3><?php _e('评论已关闭'); ?></h3>
    <?php endif; ?>
    <?php endif; ?>
	
    
</div>