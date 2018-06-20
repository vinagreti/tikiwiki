{* $Id: tiki-syslog.tpl 65590 2018-02-27 11:44:49Z chibaguy $ *}
{title help="System Log"}{tr}Tiki Logs{/tr}{/title}

<div class="t_navbar margin-bottom-md">
	<a href="tiki-sqllog.php" class="btn btn-link" title="{tr}Log SQL{/tr}">{icon name="pencil"} {tr}Log SQL{/tr}</a>
	<a href="tiki-admin_actionlog.php#Report" class="btn btn-link" title="{tr}Export through Action Log{/tr}">{icon name="upload"} {tr}Export through Action Log{/tr}</a>
{*	{button class="btn btn-default" _text="{tr}Log SQL{/tr}" href="tiki-sqllog.php"}
	{button class="btn btn-default" _text="{tr}Export through Action Log{/tr}" href="tiki-admin_actionlog.php#Report"}
*}</div>

<form method="get" action="tiki-syslog.php" class="form-inline margin-bottom-md">
	<div class="form-group">
		<label>{tr}Clean logs older than{/tr}&nbsp;
		<input type="text" name="months" class="form-control"></label> {tr}months{/tr}
	</div>
	<input type="submit" class="btn btn-default btn-sm" value="{tr}Clean{/tr}" name="clean">
</form>

{include file='find.tpl'}

{pagination_links cant=$cant step=$maxRecords offset=$offset}{/pagination_links}

<div class="table-responsive syslog-table">
	<table class="table">
		<tr>
			<th>{self_link _sort_arg="sort_mode" _sort_field="actionid"}{tr}Id{/tr}{/self_link}</th>
			<th>{self_link _sort_arg="sort_mode" _sort_field="action"}{tr}Type{/tr}{/self_link}</th>
			<th>{self_link _sort_arg="sort_mode" _sort_field="lastModif"}{tr}Time{/tr}{/self_link}</th>
			<th>{self_link _sort_arg="sort_mode" _sort_field="user"}{tr}User{/tr}{/self_link}</th>
			<th>{self_link _sort_arg="sort_mode" _sort_field="comment"}{tr}Message{/tr}{/self_link}</th>
			<th>{self_link _sort_arg="sort_mode" _sort_field="ip"}{tr}IP{/tr}{/self_link}</th>
			<th>{self_link _sort_arg="sort_mode" _sort_field="client"}{tr}Client{/tr}{/self_link}</th>
		</tr>

		{section name=ix loop=$list}
			<tr>
				<td class="id">{$list[ix].actionId}</td>
				<td class="text">{$list[ix].object|escape}</td>
				<td class="date"><span title="{$list[ix].lastModif|tiki_long_datetime}">{$list[ix].lastModif|tiki_short_datetime}</span></td>
				<td class="username">{$list[ix].user|userlink}</td>
				<td class="text"><textarea class="form-control" readonly="readonly">{$list[ix].action|escape:'html'}</textarea></td>
				<td class="text">{$list[ix].ip|escape:"html"}</td>
				<td class="text"><span title="{$list[ix].client|escape:'html'}">{$list[ix].client|truncate:30:"..."|escape:'html'}</span></td>
				<td>
					{if $list[ix].object == 'profile apply'}
						<form method="post" action="tiki-syslog.php" onsubmit="return confirm('{tr}Are you sure you want to revert{/tr} &QUOT;{$list[ix].action|escape}&QUOT;?');">
							{ticket}
							<input type="hidden" name="page" value="profiles">
							<input type="hidden" name="actionId" value="{$list[ix].actionId}">
							<input type="submit" class="btn btn-primary" name="revert" value="{tr}Revert{/tr}">
						</form>
					{/if}
				</td>
			</tr>
		{/section}
	</table>
</div>

{pagination_links cant=$cant step=$maxRecords offset=$offset}{/pagination_links}

