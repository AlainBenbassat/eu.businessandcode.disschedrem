
<div class="view-content">
  <div class="crm-block crm-content-block">

    <table>
      <thead>
      <tr>
        <th>Datum</th>
        <th>Evenement</th>
        <th>Soort herinnering</th>
        <th>Succesvol verzonden</th>
        <th>Niet verzonden</th>
      </tr>
      </thead>

      <tbody>
      {foreach from=$records item=record}
        <tr class="{cycle values="odd-row,even-row"}">
          <td>{$record.$fieldName}</td>
        </tr>
      {/foreach}
      </tbody>
    </table>

  </div>
</div>


