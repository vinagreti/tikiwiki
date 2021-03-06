{strip}
	{if $field.options_map['wysiwyg'] eq 'y'}
		{textarea _class='form-control' id=$data.element_id name=$field.ins_id rows=$data.rows onkeyup=$data.keyup _wysiwyg='y' section="trackers"  switcheditor='n'}
			{$field.page_data}
		{/textarea}
	{else}
		{textarea _class='form-control' id=$data.element_id name=$field.ins_id _toolbars=$data.toolbar _simple='y' rows=$data.rows onkeyup=$data.keyup _wysiwyg='n' section="trackers"  switcheditor='n'}
			{$field.page_data}
		{/textarea}
	{/if}
	{if $field.options_map['max']}
		<div class="charCount">
			{if $prefs.javascript_enabled eq 'y'}
				{tr}Character Count:{/tr} <input type="text" id="cpt_{$field.fieldId}" size="4" readOnly="true"{if !empty($field.page_data)} value="{$field.page_data|count_characters}"{/if}>
			{/if}
			{if $field.options_map['max'] > 0} {tr}Max:{/tr} {$field.options_map['max']}{/if}
		</div>
	{/if}
	{if $field.options_map['wordmax']}
		<div class="wordCount">
			{if $prefs.javascript_enabled eq 'y'}
				{tr}Word Count:{/tr} <input type="text" id="cpt_{$field.fieldId}" size="4" readOnly="true"{if !empty($field.page_data)} value="{$field.page_data|count_words}"{/if}>
			{/if}
			{if $field.options_map['wordmax'] > 0} {tr}Max:{/tr} {$field.options_map['wordmax']}{/if}
		</div>
	{/if}
	{if $field.options_map['actions']}
		<div class="wiki-field btn-bar">
			{if $data.perms.view}
				{button _keepall='y' href=$field.value|sefurl _text="{tr}View{/tr}" _title="{tr}View stand alone wiki page{/tr}" _class='btn-sm'}
			{/if}
			{if $prefs.feature_source eq 'y' and $data.perms.wiki_view_source}
				{button _keepall='y' href='tiki-pagehistory.php' page=$field.value source='0' _text="{tr}Source{/tr}" _title="{tr}Source of wiki page{/tr}" _class='btn-sm' _type='info'}
			{/if}
			{if $prefs.feature_history eq 'y' and $data.perms.wiki_view_history}
				{button _keepall='y' href='tiki-pagehistory.php' page=$page _text="{tr}History{/tr}" _title="{tr}History of wiki page{/tr}" _class='btn-sm' _type='info'}
			{/if}
		</div>
	{/if}
{/strip}
