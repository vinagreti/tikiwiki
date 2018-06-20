{* $Id: include_messages.tpl 62265 2017-04-19 01:00:45Z lindonb $ *}

<form class="form-horizontal" action="tiki-admin.php?page=messages" method="post" name="messages">
	{ticket}

	<div class="row">
		<div class="form-group col-lg-12 clearfix">
			{include file='admin/include_apply_top.tpl'}
		</div>
	</div>

	<fieldset>
		<legend>{tr}Activate the feature{/tr}</legend>
		{preference name=feature_messages visible="always"}
	</fieldset>

	<fieldset>
		<legend>{tr}Settings{/tr}</legend>

		{preference name=allowmsg_by_default}
		{preference name=allowmsg_is_optional}
		{preference name=messu_mailbox_size}
		{preference name=messu_archive_size}
		{preference name=messu_sent_size}
		{preference name=user_selector_realnames_messu}
		{preference name=messu_truncate_internal_message}

	</fieldset>
	{include file='admin/include_apply_bottom.tpl'}
</form>
