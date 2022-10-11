<div class="pricingTable">
    <div class="blank"></div>
    <a class="Basique pricingHeader w-100 col1 text-center" offer="basique">{{__("Basique")}}</a>
    <a class="Standard pricingHeader w-100 col2 text-center" offer="standard">Standard</a>
    <a class="Entreprise pricingHeader w-100 col3 text-center" offer="entreprise">{{__("Entreprise")}}</a>
    <a class="Dedie pricingHeader w-100 col4 text-center" offer="dédié">{{__("Dédié")}}</a>
    <div class="Seafile pricingReference">Seafile</div>
    <div class="Nextcloud pricingReference">Nextcloud</div>
    <div class="Pydio pricingReference">Pydio</div>
    <div class="ssh pricingReference">SSH</div>
    <div class="RSYNC pricingReference">RSYNC</div>
    <div class="SFTP pricingReference">SFTP</div>
    <div class="FTPSFTP pricingReference">FTP/SFTP</div>
    <div class="ISCSI pricingReference">ISCSI</div>
    <div class="CIFS pricingReference">CIFS</div>
    <div class="Webdav pricingReference">Webdav</div>
    <div class="SI pricingReference">SI</div>
    <a tabindex="0" offer="basique" class="colContainer col1 popover-dismiss d-block w-100" role="button" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Répartition des données" data-bs-content="1 serveur" data-bs-placement="right">
        <div class="AB check">
            <input type="radio" name="buttonsRadioForOffer" id="seafileOfferBasique" value="seafileOfferBasique" form="formAddToCart" {{ old('buttonsRadioForOffer') == 'seafileOfferBasique' ? 'checked' : '' }}>
            <label for="seafileOfferBasique" class="d-none d-sm-inline">Seafile</label>
        </div>
        <div class="AC check">
            <input type="radio" name="buttonsRadioForOffer" id="nextcloudOfferBasique" value="nextcloudOfferBasique" form="formAddToCart" {{ old('buttonsRadioForOffer') == 'nextcloudOfferBasique' ? 'checked' : '' }}>
            <label for="nextcloudOfferBasique" class="d-none d-sm-inline">Nextcloud</label>
        </div>
        <div class="AA check">
            <input disabled type="radio" name="buttonsRadioForOffer" id="pydioOfferBasique" value="pydioOfferBasique" form="formAddToCart" {{ old('buttonsRadioForOffer') == 'pydioOfferBasique' ? 'checked' : '' }}>
            <label for="pydioOfferBasique" class="d-none d-sm-inline">Pydio</label>
        </div>
        @error('buttonsRadioForOffer')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="AD"><i class="fa-solid fa-xmark"></i></div>
        <div class="AE"><i class="fa-solid fa-xmark"></i></div>
        <div class="AF"><i class="fa-solid fa-xmark"></i></div>
        <div class="AG"><i class="fa-solid fa-xmark"></i></div>
        <div class="AH"><i class="fa-solid fa-xmark"></i></div>
        <div class="AI"><i class="fa-solid fa-xmark"></i></div>
        <div class="AJ"><i class="fa-solid fa-xmark"></i></div>
        <div class="AK"><i class="fa-solid fa-xmark"></i></div>
    </a>
    <a tabindex="1" offer="standard" class="colContainer col2 popover-dismiss d-block w-100 selected" role="button" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Répartition des données" data-bs-content="2 serveurs" data-bs-placement="right">
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
    </a>
    <a tabindex="2" offer="entreprise" class="colContainer col3 popover-dismiss d-block w-100" role="button" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Répartition des données" data-bs-content="3 serveurs et 2 datacenters" data-bs-placement="left">
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
    </a>
    <a tabindex="3" offer="dédié" class="colContainer col4 popover-dismiss d-block w-100" role="button" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Répartition des données" data-bs-content="3 serveurs et 2 datacenters" data-bs-placement="left">
      <div class="DB check">
          <input type="radio" name="buttonsRadioForOffer" id="seafileOfferDedicated" value="seafileOfferDedicated" form="formAddToCart" {{ old('buttonsRadioForOffer') == 'seafileOfferDedicated' ? 'checked' : '' }}>
          <label for="seafileOfferDedicated" class="d-none d-sm-inline">Seafile</label>
      </div>
      <div class="DC check">
          <input type="radio" name="buttonsRadioForOffer" id="nextcloudOfferDedicated" value="nextcloudOfferDedicated" form="formAddToCart" {{ old('buttonsRadioForOffer') == 'nextcloudOfferDedicated' ? 'checked' : '' }}>
          <label for="nextcloudOfferDedicated" class="d-none d-sm-inline">Nextcloud</label>
      </div>
      <div class="DA check">
        <input disabled type="radio" name="buttonsRadioForOffer" id="pydioOfferDedicated" value="pydioOfferDedicated" form="formAddToCart" {{ old('buttonsRadioForOffer') == 'pydioOfferDedicated' ? 'checked' : '' }}>
        <label for="pydioOfferDedicated" class="d-none d-sm-inline">Pydio</label>
    </div>
      <div class="DD"><i class="fa-solid fa-xmark"></i></div>
      <div class="DE"><i class="fa-solid fa-xmark"></i></div>
      <div class="DF"><i class="fa-solid fa-xmark"></i></div>
      <div class="DG"><i class="fa-solid fa-xmark"></i></div>
      <div class="DH"><i class="fa-solid fa-xmark"></i></div>
      <div class="DI"><i class="fa-solid fa-xmark"></i></div>
      <div class="DJ"><i class="fa-solid fa-xmark"></i></div>
      <div class="DK"><i class="fa-solid fa-xmark"></i></div>
    </a>
  </div>
