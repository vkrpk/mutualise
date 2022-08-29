<div class="pricingTable">
    <div class="Basique pricingHeader col1">Basique</div>
    <div class="Standard pricingHeader col2">Standard</div>
    <div class="Entreprise pricingHeader col3">Entreprise</div>
    <div class="Dedie pricingHeader col4">Dédié</div>
    <div class="Pydio pricingReference">Pydio</div>
    <div class="Seafile pricingReference">Seafile</div>
    <div class="Nextcloud pricingReference">Nextcloud</div>
    <div class="ssh pricingReference">SSH</div>
    <div class="RSYNC pricingReference">RSYNC</div>
    <div class="SFTP pricingReference">SFTP</div>
    <div class="FTPSFTP pricingReference">FTP/SFTP</div>
    <div class="ISCSI pricingReference">ISCSI</div>
    <div class="CIFS pricingReference">CIFS</div>
    <div class="Webdav pricingReference">Webdav</div>
    <div class="SI pricingReference">SI</div>
    <div class="blank"></div>
    <div class="AA check col1"><i class="fa-solid fa-check"></i></div>
    <div class="AB check col2"><i class="fa-solid fa-check"></i></div>
    <div class="AC check col3"><i class="fa-solid fa-check"></i></div>
    <div class="BA check col1"><i class="fa-solid fa-check"></i></div>
    <div class="BB check col2"><i class="fa-solid fa-check"></i></div>
    <div class="BC check col3"><i class="fa-solid fa-check"></i></div>
    <div class="CA check col1"><i class="fa-solid fa-check"></i></div>
    <div class="CB check col2"><i class="fa-solid fa-check"></i></div>
    <div class="CC check col3"><i class="fa-solid fa-check"></i></div>
    <div class="DA col1"><i class="fa-solid fa-xmark"></i></div>
    <div class="DB check col2"><i class="fa-solid fa-check"></i></div>
    <div class="DC check col3"><i class="fa-solid fa-check"></i></div>
    <div class="EA col1"><i class="fa-solid fa-xmark"></i></div>
    <div class="EB check col2"><i class="fa-solid fa-check"></i></div>
    <div class="EC check col3"><i class="fa-solid fa-check"></i></div>
    <div class="FA col1"><i class="fa-solid fa-xmark"></i></div>
    <div class="FB check col2"><i class="fa-solid fa-check"></i></div>
    <div class="FC check col3"><i class="fa-solid fa-check"></i></div>
    <div class="GA col1"><i class="fa-solid fa-xmark"></i></div>
    <div class="GB check col2"><i class="fa-solid fa-check"></i></div>
    <div class="GC check col3"><i class="fa-solid fa-check"></i></div>
    <div class="HA col1"><i class="fa-solid fa-xmark"></i></div>
    <div class="HB col2"><i class="fa-solid fa-xmark"></i></div>
    <div class="HC check col3"><i class="fa-solid fa-check"></i></div>
    <div class="IA col1"><i class="fa-solid fa-xmark"></i></div>
    <div class="IB col2"><i class="fa-solid fa-xmark"></i></div>
    <div class="IC check col3"><i class="fa-solid fa-check"></i></div>
    <div class="JA col1"><i class="fa-solid fa-xmark"></i></div>
    <div class="JB col2"><i class="fa-solid fa-xmark"></i></div>
    <div class="JC check col3"><i class="fa-solid fa-check"></i></div>
    <div class="KA col1"><i class="fa-solid fa-xmark"></i></div>
    <div class="KB col2"><i class="fa-solid fa-xmark"></i></div>
    <div class="KC check col3"><i class="fa-solid fa-check"></i></div>
    <div class="AD col4" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="3 serveurs et 2 datacenters">
      <div class="ADA">
          <input type="radio" name="dedicatedChoice" id="dedicatedChoice" value="pydio">
          <label for="dedicatedChoice">Pydio</label>
      </div>
      <div class="ADB">
          <input type="radio" name="dedicatedChoice" id="dedicatedChoice" value="seafile">
          <label for="dedicatedChoice">Seafile</label>
      </div>
      <div class="ADC">
          <input type="radio" name="dedicatedChoice" id="dedicatedChoice" value="nextcloud">
          <label for="dedicatedChoice">Nextcloud</label>
      </div>
    </div>
  </div>

  <button type="button" class="btn btn-secondary" >
    Popover on bottom
  </button>

<script defer>
    const col_1 = document.querySelectorAll('.col1');
    const col_2 = document.querySelectorAll('.col2');
    const col_3 = document.querySelectorAll('.col3');
    const col_4 = document.querySelectorAll('.col4');
    const inputs = document.querySelectorAll('input[id="dedicatedChoice"]')
    const col_collection = [col_1, col_2, col_3, col_4];

    col_collection.forEach(
        column => column.forEach(
            element => element.addEventListener('click',
                function() {
                    getUnselected(col_collection);
                    getSelected(column);
                })))

    function getUnselected(col_collection) {
        col_collection.forEach(
            column => column.forEach(
                element => element.classList.remove('selected',
                    )));
    }

    function getSelected(column) {
        column.forEach(element => element.classList.add('selected'));
        if(column == col_1 || column == col_2 || column == col_3) {
            inputs.forEach(
                input => input.checked = false
            )
        }
    }


</script>
