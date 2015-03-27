<?php
/**
 * Kunena Component
 * @package     Kunena.Template.Crypsis
 * @subpackage  Layout.Topic
 *
 * @copyright   (C) 2008 - 2015 Kunena Team. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        http://www.kunena.org
 **/
defined('_JEXEC') or die;

/** @var KunenaLayout $this */
/** @var KunenaForumTopic $topic */
$topic = $this->topic;
$category = $topic->getCategory();
$userTopic = $topic->getUserTopic();
$topicPages = $topic->getPagination(null, KunenaConfig::getInstance()->messages_per_page, 3);
$avatar = $topic->getLastPostAuthor()->getAvatarImage('img-thumbnail', 48);
$config = KunenaConfig::getInstance();
$cols = empty($this->checkbox) ? 5 : 6;

if (!empty($this->spacing)) : ?>
	<tr class="kcontenttablespacer">
		<td colspan="<?php echo $cols; ?>">&nbsp;</td>
	</tr>
<?php endif; ?>

<tr class="category<?php echo $this->escape($category->class_sfx); ?>">
	<td class="span1 hidden-phone center">
		<?php echo $this->getTopicLink($topic, 'unread', $topic->getIcon()); ?>
	</td>
	<td class="span<?php echo $cols?>">
		<div>
			<?php echo $this->getTopicLink($topic, null, null, null, 'hasTooltip topictitle'); ?>
			<?php
			if ($topic->unread)
			{
				echo $this->getTopicLink($topic, 'unread',
					'<sup class="knewchar" dir="ltr">(' . (int) $topic->unread . ' ' . JText::_('COM_KUNENA_A_GEN_NEWCHAR') . ')</sup>');
			}
			?>
		</div>
		<div class="pull-right">
			<?php if ($userTopic->favorite) : ?>
				<i class="icon-star hasTooltip"><?php JText::_('COM_KUNENA_FAVORITE'); ?></i>
			<?php endif; ?>

			<?php if ($userTopic->posts) : ?>
				<i class="icon-flag hasTooltip"><?php JText::_('COM_KUNENA_MYPOSTS'); ?></i>
			<?php endif; ?>

			<?php if ($this->topic->attachments) : ?>
				<i class="icon-flag-2 hasTooltip"><?php JText::_('COM_KUNENA_ATTACH'); ?></i>
			<?php endif; ?>

			<?php if ($this->topic->poll_id) : ?>
				<i class="icon-bars hasTooltip"><?php JText::_('COM_KUNENA_ADMIN_POLLS'); ?></i>
			<?php endif; ?>
		</div>

		<div class="hidden-phone">
			<?php echo JText::_('COM_KUNENA_TOPIC_STARTED_ON')?>,
			<?php echo $topic->getFirstPostTime()->toKunena('config_post_dateformat'); ?>,
			<?php echo JText::_('COM_KUNENA_BY') ?>
			<?php echo $topic->getAuthor()->getLink(); ?>
			<div class="pull-right">
				<?php /** TODO: New Feature - LABELS
				<span class="label label-info">
				<?php echo JText::_('COM_KUNENA_TOPIC_ROW_TABLE_LABEL_QUESTION'); ?>
				</span>	*/ ?>
				<?php if ($topic->locked != 0) : ?>
					<span class="label label-important">
						<i class="icon-locked"><?php JText::_('COM_KUNENA_LOCKED'); ?></i>
					</span>
				<?php endif; ?>
			</div>
		</div>

		<div class="visible-phone">
			<?php echo JText::_('COM_KUNENA_GEN_LAST_POST')?>
			<?php echo  $topic->getLastPostTime()->toKunena('config_post_dateformat'); ?> <br>
			<?php echo JText::_('COM_KUNENA_BY') . ' ' . $this->topic->getLastPostAuthor()->getLink();?>
			<div class="pull-right">
				<?php /** TODO: New Feature - LABELS
				<span class="label label-info">
				<?php echo JText::_('COM_KUNENA_TOPIC_ROW_TABLE_LABEL_QUESTION'); ?>
				</span>	*/ ?>
				<?php if ($topic->locked != 0) : ?>
					<span class="label label-important">
						<i class="icon-locked"><?php JText::_('COM_KUNENA_LOCKED'); ?></i>
					</span>
				<?php endif; ?>
			</div>
		</div>

		<div class="pull-left">
			<?php echo $this->subLayout('Widget/Pagination/List')->set('pagination', $topicPages)->setLayout('simple'); ?>
		</div>
	</td>

	<td class="span2 hidden-phone">
		<div>
			<div class="repliesnum pull-right">
				<span class="topictitle"><strong><?php echo $this->formatLargeNumber($topic->getReplies()); ?></strong></span>
			</div>
			<div class="replies pull-left">
				<span class="topictitle"><strong><?php echo JText::_('COM_KUNENA_GEN_REPLIES'); ?>:</strong></span>
			</div>
		</div>
		<div class="clearfix"></div>
		<div>
			<div class="viewsnum pull-right">
				<?php echo  $this->formatLargeNumber($topic->hits); ?>
			</div>
			<div class="views pull-left">
				<?php echo JText::_('COM_KUNENA_GEN_HITS');?>:
			</div>
		</div>
	</td>

	<td class="span2 hidden-phone" id="recent-topics">
		<?php if ($config->avataroncat) : ?>
			<div class="span2 hidden-phone">
				<?php echo $avatar; ?>
			</div>
			<div class="span10 last-avatar">
		<?php endif; ?>
		<?php if (!$config->avataroncat) : ?>
			<div class="span12">
		<?php endif; ?>
				<span><?php echo $this->getTopicLink ($this->topic, 'last', JText::_('COM_KUNENA_GEN_LAST_POST')); ?>
					<?php echo ' ' . JText::_('COM_KUNENA_BY') . ' ' . $this->topic->getLastPostAuthor()->getLink();?></span>
				<br>
				<span><?php echo $topic->getLastPostTime()->toKunena('config_post_dateformat'); ?></span>
			</div>
	</td>

	<?php if (!empty($this->checkbox)) : ?>
		<td class="center">
			<label>
				<input class="kcheck" type="checkbox" name="topics[<?php echo $topic->displayField('id'); ?>]" value="1" />
			</label>
		</td>
	<?php endif; ?>

	<?php
	if (!empty($this->position))
		echo $this->subLayout('Widget/Module')
			->set('position', $this->position)
			->set('cols', $cols)
			->setLayout('table_row');
	?>
</tr>
