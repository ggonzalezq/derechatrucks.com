<h1><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('user/grouplist','Groups');?></h1>
<?php
	$canEdit = $currentUser->hasAccessTo('lhuser','editgroup');
	$canDelete = $currentUser->hasAccessTo('lhuser','deletegroup');
?>
<table class="lentele" cellpadding="0" cellspacing="0" width="100%">
<thead>
<tr>
    <th>ID</th>
    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('user/grouplist','Name');?></th>
    <?php if ($canEdit) : ?><th width="1%">&nbsp;</th><?php endif;?>
    <?php if ($canDelete) : ?><th width="1%">&nbsp;</th><?php endif;?>
</tr>
</thead>
<?php foreach ($groups as $group) : ?>
    <tr>
        <td width="1%"><?php echo $group->id?></td>
        <td><?php echo htmlspecialchars($group->name)?></td>
        <?php if ($canEdit) : ?><td nowrap><a class="small button round" href="<?php echo erLhcoreClassDesign::baseurl('user/editgroup')?>/<?php echo $group->id?>"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('user/grouplist','Edit group');?></a></td><?php endif;?>
        <?php if ($canDelete) : ?><td nowrap><a class="small alert button round csfr-required" onclick="return confirm('<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('gallery/album_list_admin','Are you sure?');?>')" href="<?php echo erLhcoreClassDesign::baseurl('user/deletegroup')?>/<?php echo $group->id?>"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('user/grouplist','Delete group');?></a></td><?php endif;?>
    </tr>
<?php endforeach; ?>
</table>

<?php include(erLhcoreClassDesign::designtpl('lhkernel/secure_links.tpl.php')); ?>

<br />
<?php if (isset($pages)) : ?>
    <?php include(erLhcoreClassDesign::designtpl('lhkernel/paginator.tpl.php')); ?>
<?php endif;?>

<?php if ($currentUser->hasAccessTo('lhuser','creategroup')) : ?>
<a class="small button" href="<?php echo erLhcoreClassDesign::baseurl('user/newgroup')?>"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('user/grouplist','New group');?></a>
<?php endif;?>