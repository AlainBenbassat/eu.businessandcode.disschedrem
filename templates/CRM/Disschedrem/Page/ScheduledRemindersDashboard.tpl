
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
      {foreach from=$rows item=row}
        <tr class="{cycle values="odd-row,even-row"}">
          <td>{$row.event_date}</td>
          <td>{$row.event_name}</td>
          <td>{$row.reminder_title}</td>
          {if $row.num_successful > 0}
            <td style="background-color: green; color:white">{$row.num_successful}</td>
          {else}
            <td>{$row.num_successful}</td>
          {/if}
          {if $row.num_with_error > 0}
            <td style="background-color: red; color:white">{$row.num_with_error}</td>
          {else}
            <td>{$row.num_with_error}</td>
          {/if}
        </tr>
      {/foreach}
      </tbody>
    </table>

    <h3>Problemen</h3>
    <table>
      <thead>
      <tr>
        <th>Datum</th>
        <th>Naam</th>
        <th>E-mail</th>
        <th>Foutboodschap</th>
      </tr>
      </thead>

      <tbody>
      {foreach from=$errors item=row}
        <tr class="{cycle values="odd-row,even-row"}">
          <td>{$row.action_date_time}</td>
          <td>{$row.display_name}</td>
          <td>{$row.email}</td>
          <td>{$row.message}</td>
        </tr>
      {/foreach}
      </tbody>
    </table>

  </div>
</div>



