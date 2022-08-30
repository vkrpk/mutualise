<div class="pricingTable">
    <div class="blank"></div>
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
    <div class="colContainer col1">
        <div class="AA check"><i class="fa-solid fa-check"></i></div>
        <div class="AB check"><i class="fa-solid fa-check"></i></div>
        <div class="AC check"><i class="fa-solid fa-check"></i></div>
        <div class="AD"><i class="fa-solid fa-xmark"></i></div>
        <div class="AE"><i class="fa-solid fa-xmark"></i></div>
        <div class="AF"><i class="fa-solid fa-xmark"></i></div>
        <div class="AG"><i class="fa-solid fa-xmark"></i></div>
        <div class="AH"><i class="fa-solid fa-xmark"></i></div>
        <div class="AI"><i class="fa-solid fa-xmark"></i></div>
        <div class="AJ"><i class="fa-solid fa-xmark"></i></div>
        <div class="AK"><i class="fa-solid fa-xmark"></i></div>
    </div>
    <div class="colContainer col2">
        <div class="BA check"><i class="fa-solid fa-check"></i></div>
        <div class="BB check"><i class="fa-solid fa-check"></i></div>
        <div class="BC check"><i class="fa-solid fa-check"></i></div>
        <div class="BD check"><i class="fa-solid fa-check"></i></div>
        <div class="BE check"><i class="fa-solid fa-check"></i></div>
        <div class="BF check"><i class="fa-solid fa-check"></i></div>
        <div class="BG check"><i class="fa-solid fa-check"></i></div>
        <div class="BH"><i class="fa-solid fa-xmark"></i></div>
        <div class="BI"><i class="fa-solid fa-xmark"></i></div>
        <div class="BJ"><i class="fa-solid fa-xmark"></i></div>
        <div class="BK"><i class="fa-solid fa-xmark"></i></div>
    </div>
    <div class="colContainer col3">
        <div class="CA check"><i class="fa-solid fa-check"></i></div>
        <div class="CB check"><i class="fa-solid fa-check"></i></div>
        <div class="CC check"><i class="fa-solid fa-check"></i></div>
        <div class="CD check"><i class="fa-solid fa-check"></i></div>
        <div class="CE check"><i class="fa-solid fa-check"></i></div>
        <div class="CF check"><i class="fa-solid fa-check"></i></div>
        <div class="CG check"><i class="fa-solid fa-check"></i></div>
        <div class="CH check"><i class="fa-solid fa-check"></i></div>
        <div class="CI check"><i class="fa-solid fa-check"></i></div>
        <div class="CJ check"><i class="fa-solid fa-check"></i></div>
        <div class="CK check"><i class="fa-solid fa-check"></i></div>
    </div>
    <div class="colContainer col4" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="3 serveurs et 2 datacenters">
      <div class="DA">
          <input type="radio" name="dedicatedChoice" id="dedicatedChoice" value="pydio">
          <label for="dedicatedChoice">Pydio</label>
      </div>
      <div class="DB">
          <input type="radio" name="dedicatedChoice" id="dedicatedChoice" value="seafile">
          <label for="dedicatedChoice">Seafile</label>
      </div>
      <div class="DC">
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
