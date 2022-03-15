<?php
/**
 * Template Name: Sem Estimator
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Uplers consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package WordPress
 * @subpackage Uplers
 * @since Uplers 1.0
 */
get_header(); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.0.3/nouislider.min.css" integrity="sha256-IQnSeew8zCA+RvM5fNRro/UY0Aib18qU2WBwGOHZOP0=" crossorigin="anonymous" />
<script src="https://unpkg.com/react@16/umd/react.production.min.js" defer></script>
<script src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js" defer></script>
<script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js" defer></script>
<script src="https://unpkg.com/axios/dist/axios.min.js" defer></script>
<script src="<?php echo get_template_directory_uri();?>/assets/js/tipso.js" defer></script>
<script type="text/javascript" src="<?php echo site_url();?>/wp-content/themes/uplers/assets/js/wNumb.min.js" defer></script>
<script type="text/javascript" src="<?php echo site_url();?>/wp-content/themes/uplers/assets/js/nouislider.min.js" defer></script>
<div id="main" class="wrapper"></div>
<script type="text/babel">
    function percentage(num, per)
    {
      return (num/100)*per;
    }
    class SemEstimatorForm extends React.Component {
        constructor(props) {
            super(props);
            this.state = {
                loading : false,
                isLoading: true,
                checkedVal: 0,
                bannerdata: [],
                monthlyMediaPrice : 1000,
                isRequestChecked: false,
                isGoogleAdsChecked : false,
                isProgressChecked: false,
                isFbInstaChecked : false,
                isTwitterAdsChecked : false,
                isLinkedInAdsChecked : false,
                isYoutubeAdsChecked : false,
                handleLinkedInAdsChecked : false,
                isBingAdsChecked : false,
                selectedBannerOption : '',
                selectedLandingOption : '',
                isOther : false,
                isBrandA : false,
                isLeads : false,
                isTraffic : false,
                isSales : false,
                errorMessage : '',
                sucessMessage : '',
                selectedLocations : '',
                semiestimatordata : {
                    url:"<?php echo site_url();?>/wp-json/acf/v3/pages/<?php echo get_the_ID();?>/",
                    method:"GET",
                },
            };     
            this.handleGoogleAdsChecked = this.handleGoogleAdsChecked.bind(this); // set this, because you need get methods from CheckBox 
            this.handleFbInstaChecked = this.handleFbInstaChecked.bind(this); // set this, because you need get methods from CheckBox 
            this.handleTwitterAdsChecked = this.handleTwitterAdsChecked.bind(this); // set this, because you need get methods from CheckBox 
            this.handleRequestChecked = this.handleRequestChecked.bind(this); // set this, because you need get methods from CheckBox
            this.handleYoutubeAdsChecked = this.handleYoutubeAdsChecked.bind(this); // set this, because you need get methods from CheckBox 
            this.handleLinkedInAdsChecked = this.handleLinkedInAdsChecked.bind(this); // set this, because you need get methods from CheckBox 
            this.handleBingAdsChecked = this.handleBingAdsChecked.bind(this); // set this, because you need get methods from CheckBox 
            this.handleBannerChange = this.handleBannerChange.bind(this);
            this.handleLandingChange = this.handleLandingChange.bind(this);
            this.handleProgressChecked = this.handleProgressChecked.bind(this); // set this, because you need get methods from CheckBox
            this.handleLocationChange = this.handleLocationChange.bind(this);
        }
        
        getDataLists = (semiestimatordata) => {
                fetch(this.state.semiestimatordata.url,{
                       method:this.state.semiestimatordata.method
                    }).then(res => {
                       return res.json()
                    }).then(data => {                        
                        this.setState({ bannerdata: data.acf, isLoading: false, });                       
                     })
                     .catch(error => this.setState({ error, isLoading: false }));
        }
         componentDidMount() {
            let $this = this;
            this.getDataLists();
            {/***************on scroll add class start********************/}
                jQuery('.animated').viewportChecker({
                        classToAdd: 'visible',
                        offset: 100
                });
            {/***************on scroll add class end********************/}
            {/***************right side tooltip start********************/}
            jQuery('.right').tipso({
				position: 'right', 
				background: 'rgba(0,0,0,0.8)',
				useTitle: false,
			});
           {/***************right side tooltip End********************/}
           jQuery(".custom-check input[type='checkbox']").on("click tap", function() {
            jQuery(this).parents('li').toggleClass('open');
            jQuery(this).prop('readonly', true);
                });
                jQuery(".close-check").on("click tap", function() {
                        jQuery(this).parents('.custom-check').removeClass('open');
                        jQuery(this).parents('.custom-check').find("input").prop({disabled: false,checked: false});
                });
                var range_all_sliders = {
                        'min': [   1000, 100 ],
                        '33%': [  3000, 100 ],
                        '66%': [  5000, 100 ],
                        'max': [ 10000 ]
                };
                var slider = document.getElementById('slider');
                noUiSlider.create(slider, {
                    start: 0,
                    connect: [true, false],
                        step: 100,
                    range: range_all_sliders,
                        tooltips: wNumb({decimals: 0, thousand: ',', prefix: '$'}),
                        pips: {
                        mode: 'range',
                        density: 30,
                        format: wNumb({
                                decimals: 0, 
                                thousand: ',', 
                                prefix: '$', 
                            })
                        }
                });
            slider.noUiSlider.on('slide', function doSomething(values, handle, unencoded, tap, positions) {
                $this.setState({monthlyMediaPrice: values[0]});
                var val = parseInt(values[0])
                jQuery(".noUi-value").removeClass('highlight')
                jQuery(".noUi-value[data-value='"+val+"']").addClass('highlight');
            });
            
        }
        handleBannerChange = (e) => {
            this.setState({
              selectedBannerOption : e.target.value,
            }); 
        }
        handleLandingChange = (e) => {
            this.setState({
              selectedLandingOption : e.target.value,
            }); 
        }
        handleGoogleAdsChecked () {
            this.setState({isGoogleAdsChecked: !this.state.isGoogleAdsChecked});
        }
        handleFbInstaChecked () {
            this.setState({isFbInstaChecked: !this.state.isFbInstaChecked});
        }
        handleTwitterAdsChecked () {
            this.setState({isTwitterAdsChecked: !this.state.isTwitterAdsChecked});
        }
        handleYoutubeAdsChecked () {
            this.setState({isYoutubeAdsChecked: !this.state.isYoutubeAdsChecked});
        }
        handleLinkedInAdsChecked () {
            this.setState({isLinkedInAdsChecked: !this.state.isLinkedInAdsChecked});
        }
        handleRequestChecked () {
            this.setState({isRequestChecked: !this.state.isRequestChecked});
        }
        handleBingAdsChecked () {
            this.setState({isBingAdsChecked: !this.state.isBingAdsChecked});
        }
        handleProgressChecked () {
            this.setState({isProgressChecked: !this.state.isProgressChecked});
        }
        toggleChangeSales = () => {
            this.setState(prevState => ({
                isSales: !prevState.isSales,
            }));
        }
        toggleChangetraffic = () => {
            this.setState(prevState => ({
                isTraffic: !prevState.isTraffic,
            }));
        }
        toggleChangeleads = () => {
            this.setState(prevState => ({
                isLeads: !prevState.isLeads,
            }));
        }
        toggleChangeBrandA = () => {
            this.setState(prevState => ({
                isBrandA: !prevState.isBrandA,
            }));
        }
        toggleChangeOther = () => {
            this.setState(prevState => ({
                isOther: !prevState.isOther,
            }));
        }
        handleLocationChange = (e) => {
            this.setState({
              selectedLocations : e.target.value,
            });            
        }


        onChange = (e) => {
            /*
            Because we named the inputs to match their
            corresponding values in state, it's
            super easy to update the state
            */
            this.setState({ [e.target.name]: e.target.value });
        }
        handleSubmit = e => {
            e.preventDefault(); 
            this.setState({ loading : true });           
            let data = {
                isGoogleAdsChecked : this.state.isGoogleAdsChecked,
                isFbInstaChecked : this.state.isFbInstaChecked,
                isTwitterAdsChecked : this.state.isTwitterAdsChecked,
                isYoutubeAdsChecked : this.state.isYoutubeAdsChecked,
                isLinkedInAdsChecked : this.state.isLinkedInAdsChecked,
                isBingAdsChecked : this.state.isBingAdsChecked,
                isSales : this.state.isSales,
                isTraffic : this.state.isTraffic,
                isLeads : this.state.isLeads,
                isBrandA : this.state.isBrandA,
                isOther : this.state.isOther, 
                selectedLocations : this.state.selectedLocations,
                isProgressChecked : this.state.isProgressChecked,
                monthlygreaterthousand : "10,000+",
                monthlyMediaPrice : this.state.monthlyMediaPrice,
                selectedBannerOption : this.state.selectedBannerOption,
                selectedLandingOption : this.state.selectedLandingOption,
                fullname: this.state.fullname,
                email: this.state.email,
                phone : this.state.phone,
                website : this.state.website,
                comments : this.state.comments,
            };
            
            axios({
                method: 'post',
                url: '<?php echo get_template_directory_uri();?>/hubspot/sem-estimator-hubspot.php',
                data: data,
            }).then((response) => {
                this.setState({ successMessage : 'Thank you for contating us!' });
                this.setState({fullname: '', email: '', phone: '', website: '' ,comments:'', loading : false}) // <= clear form input here
                setTimeout(() => this.setState({successMessage:''}), 5000);
            }, (error) => {
                this.setState({ errorMessage : 'There was an error!' });
                this.setState({ loading : false}) // <= clear form input here
                setTimeout(() => this.setState({errorMessage: ''}), 5000);
            });
        };

        render() {
            const {loading, isLoading, bannerdata, monthlyMediaPrice, isGoogleAdsChecked, isFbInstaChecked, isRequestChecked, isProgressChecked, isTwitterAdsChecked, isYoutubeAdsChecked, isLinkedInAdsChecked, isBingAdsCheckedm, selectedBannerOption, selectedLandingOption, fullname, email, phone, website, comments} = this.state;
            var checkedGoogleAdsVal, requestCheckedVal, checkedFbInstaVal, progressCheckedVal, perVal, compareVal, checkedTwitterAdsVal, checkedYoutubeAdsVal, checkedLinkedInAdsVal, checkedBingAdsVal, bannerPrice, landingPrice, servicePrice, campaignPrice, firstMonthTotal, chekckedServiceTotal, serviceTotal, campaignTotal;

                 if (this.state.isRequestChecked) {
                    requestCheckedVal="checked";
                } else {
                    requestCheckedVal="";
                }       
            {/******************Check Banner Option Start**********************************/}    
                if(selectedBannerOption == "yes"){
                    bannerPrice = Number(bannerdata.banner_price);
                } else if(selectedBannerOption == "no"){    
                    bannerPrice = '0';
                }    
            {/******************Check Banner Option End***********************************/}
            {/******************Check Landing Option Start********************************/}    
                if(selectedLandingOption == "yes"){
                    landingPrice = Number(bannerdata.landing_page_price);
                } else if(selectedLandingOption == "no"){    
                    landingPrice = '0';
                }    
            {/******************Check Landing Option End***********************************/}
            {/******************Google Ads Media spend calculation Start*********************************/}
                    if (this.state.isProgressChecked) {
                        progressCheckedVal="checked";
                        servicePrice =  Number(bannerdata.google_fb_instagram_linkedin_twitter_ads_media_spend_four);                            
                        campaignPrice = Number(bannerdata.google_fb_instagram_linkedin_twitter_ads_media_spend_campaign_four);
                    } else {
                        progressCheckedVal="";
                        if(monthlyMediaPrice>=0 && monthlyMediaPrice<=3000){
                            servicePrice = Number(bannerdata.google_fb_instagram_linkedin_twitter_ads_media_spend_one); 
                            campaignPrice = Number(bannerdata.google_fb_instagram_linkedin_twitter_ads_media_spend_campaign_one); 
                        } else if(monthlyMediaPrice>=3001 && monthlyMediaPrice<=5000){
                            servicePrice = Number(bannerdata.google_fb_instagram_linkedin_twitter_ads_media_spend_two);                            
                            campaignPrice = Number(bannerdata.google_fb_instagram_linkedin_twitter_ads_media_spend_campaign_two); 
                        } else if(monthlyMediaPrice>=5001 && monthlyMediaPrice<=10000){    
                            perVal =  percentage(Number(monthlyMediaPrice), Number(bannerdata.google_fb_instagram_linkedin_twitter_ads_media_spend_three)); 
                            compareVal = Number(bannerdata.google_fb_instagram_linkedin_twitter_ads_media_spend_three_copy); 
                            if(compareVal !=""){
                                compareVal=compareVal;
                            } else {
                                compareVal="0";
                            } 

                            if(Number(perVal) > Number(compareVal)){
                                servicePrice = Number(perVal);                        
                            } else {
                                servicePrice = Number(compareVal);
                            }                       
                            
                            campaignPrice = Number(bannerdata.google_fb_instagram_linkedin_twitter_ads_media_spend_campaign_three); 
                        }
                    }
            {/******************Google Ads Media spend calculation End****************************/}
            if (this.state.isGoogleAdsChecked) {
                checkedGoogleAdsVal = '1';                    
            } else {
                checkedGoogleAdsVal = '0';                 
            }
            if (this.state.isFbInstaChecked) {
                checkedFbInstaVal = '1';
            } else {
                checkedFbInstaVal = '0'; 
            }
            if (this.state.isTwitterAdsChecked) {
                checkedTwitterAdsVal = '1';
            } else {
                checkedTwitterAdsVal = '0'; 
            }
            if (this.state.isYoutubeAdsChecked) {
                checkedYoutubeAdsVal = '1';
            } else {
                checkedYoutubeAdsVal = '0'; 
            }
            if (this.state.isLinkedInAdsChecked) {
                checkedLinkedInAdsVal = '1';
            } else {
                checkedLinkedInAdsVal = '0'; 
            }
            if (this.state.isBingAdsChecked) {
                checkedBingAdsVal = '1';
            } else {
                checkedBingAdsVal = '0'; 
            }
            chekckedServiceTotal = Number(checkedGoogleAdsVal) + Number(checkedFbInstaVal) + Number(checkedTwitterAdsVal) + Number(checkedYoutubeAdsVal) + Number(checkedLinkedInAdsVal) + Number(checkedBingAdsVal);
            serviceTotal = Number(chekckedServiceTotal) * Number(servicePrice);
            campaignTotal = Number(chekckedServiceTotal) * Number(campaignPrice);   
            if(campaignTotal>0){
                campaignTotal=campaignTotal;
            } else {
                campaignTotal=0;
            } 
            if(bannerPrice > 0){
                bannerPrice=bannerPrice;
            } else {
                bannerPrice=0;
            }
            if(landingPrice>0){
                landingPrice=landingPrice;
            } else {
                landingPrice=0;
            }
            firstMonthTotal = Number(serviceTotal) + Number(campaignTotal) + Number(bannerPrice) + Number(landingPrice);
            if(firstMonthTotal>0){
                firstMonthTotal=firstMonthTotal;
            } else {
                firstMonthTotal=0;
            }
            return (
                <div className="email-estimator-pg">
                    <section className="moduleOne sm-cont">
                        <div className="container">
                            <div className="row align-items-center">
                                <div className="left-content col-md-6 animated fadeInUp">
                                    <h1 dangerouslySetInnerHTML={{__html: bannerdata.content_quote}} />
                                </div>
                                <div className="right-img col-md-6 animated fadeWscale">
                                    <figure> <img alt="banner-img" src={bannerdata.banner_image_quote} /> </figure>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section className="estimat-section">
                            <div className="container">
                                <div className="row">
                                    <div className="col-lg-7 col-md-12">
                                        <div className="estimat-content">
                                            <h3>{bannerdata.section_title}</h3>
                                            <ul className="estimat-listing">
                                                <li>
                                                    <h4>Services</h4>
                                                    <ul className="custom-listing-check">
                                                        <li className="custom-check" >
                                                            <i className="close-check" onClick={this.handleGoogleAdsChecked}></i>
                                                            <div className="custom-chk">
                                                                <input type="checkbox" id="services-chk-1" value={checkedGoogleAdsVal} onChange={ this.handleGoogleAdsChecked } checked={(this.state.isGoogleAdsChecked) ? 'checked' : '' }/>
                                                                <label for="services-chk-1">Google Ads</label>
                                                                <span className="plus"></span>
                                                            </div>
                                                        </li>
                                                        <li className="custom-check">
                                                            <i className="close-check" onClick={this.handleFbInstaChecked}></i>
                                                            <div className="custom-chk">
                                                                <input type="checkbox" id="services-chk-2" value={checkedFbInstaVal} onChange={ this.handleFbInstaChecked } />
                                                                <label for="services-chk-2">Facebook &amp; Instagram Ads</label>
                                                                <span className="plus"></span>
                                                            </div>
                                                        </li>
                                                        <li className="custom-check">
                                                            <i className="close-check" onClick={this.handleTwitterAdsChecked}></i>
                                                            <div className="custom-chk">
                                                                <input type="checkbox" id="services-chk-3" value={checkedTwitterAdsVal} onChange={ this.handleTwitterAdsChecked } />
                                                                <label for="services-chk-3">Twitter Ads</label>
                                                                <span className="plus"></span>
                                                            </div>
                                                        </li>

                                                        <li className="custom-check">
                                                            <i className="close-check" onClick={this.handleYoutubeAdsChecked}></i>
                                                            <div className="custom-chk">
                                                                <input type="checkbox" id="services-chk-4" value={checkedYoutubeAdsVal} onChange={ this.handleYoutubeAdsChecked } />
                                                                <label for="services-chk-4">YouTube Ads</label>
                                                                <span className="plus"></span>
                                                            </div>
                                                        </li>
                                                        <li className="custom-check">
                                                            <i className="close-check" onClick={this.handleLinkedInAdsChecked}></i>
                                                            <div className="custom-chk">
                                                                <input type="checkbox" id="services-chk-5" value={checkedLinkedInAdsVal} onChange={ this.handleLinkedInAdsChecked } />
                                                                <label for="services-chk-5">LinkedIn Ads</label>
                                                                <span className="plus"></span>
                                                            </div>
                                                        </li>
                                                        <li className="custom-check">
                                                            <i className="close-check" onClick={this.handleBingAdsChecked}></i>
                                                            <div className="custom-chk">
                                                                <input type="checkbox" id="services-chk-6" value={checkedBingAdsVal} onChange={ this.handleBingAdsChecked } />
                                                                <label for="services-chk-6">Bing Ads</label>
                                                                <span className="plus"></span>
                                                            </div>
                                                        </li>
                                                    </ul>

                                                </li>

                                                <li>
                                                    <h4>Marketing Goals</h4>
                                                    <ul className="custom-listing-check">
                                                        <li className="custom-check">
                                                            <i className="close-check"></i>
                                                            <div className="custom-chk">
                                                                <input type="checkbox" id="goals-chk-1" onChange={this.toggleChangeSales} checked={this.state.isSales} />
                                                                <label for="goals-chk-1">Sales / Revenue</label>
                                                                <span className="plus"></span>
                                                            </div>
                                                        </li>
                                                        <li className="custom-check">
                                                            <i className="close-check"></i>
                                                            <div className="custom-chk">
                                                                <input type="checkbox" id="goals-chk-2" onChange={this.toggleChangetraffic} checked={this.state.isTraffic} />
                                                                <label for="goals-chk-2">Website Traffic</label>
                                                                <span className="plus"></span>
                                                            </div>
                                                        </li>
                                                        <li className="custom-check">
                                                            <i className="close-check"></i>
                                                            <div className="custom-chk">
                                                                <input type="checkbox" id="goals-chk-3" onChange={this.toggleChangeleads} checked={this.state.isLeads} />
                                                                <label for="goals-chk-3">Leads</label>
                                                                <span className="plus"></span>
                                                            </div>
                                                        </li>

                                                        <li className="custom-check">
                                                            <i className="close-check"></i>
                                                            <div className="custom-chk">
                                                                <input type="checkbox" id="goals-chk-4" onChange={this.toggleChangeBrandA} checked={this.state.isBrandA} />
                                                                <label for="goals-chk-4">Brand Awareness</label>
                                                                <span className="plus"></span>
                                                            </div>
                                                        </li>
                                                        <li className="custom-check">
                                                            <i className="close-check"></i>
                                                            <div className="custom-chk">
                                                                <input type="checkbox" id="goals-chk-5" onChange={this.toggleChangeOther} checked={this.state.isOther}  />
                                                                <label for="goals-chk-5">Others</label>
                                                                <span className="plus"></span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>

                                                <li>
                                                    <h4>Locations</h4>
                                                    <ul className="custom-chk-round">
                                                        <li>
                                                            <div className="custom-radio">
                                                                <input type="radio" id="locations-1" value="Locally" name="radioDemo" checked={this.state.selectedLocations === 'Locally'} onChange={this.handleLocationChange} />
                                                                <label for="locations-1">Locally</label>
                                                            </div>
                                                        </li> 
                                                        <li>
                                                            <div className="custom-radio">
                                                                <input type="radio" id="locations-2" value="Nationally" name="radioDemo" checked={this.state.selectedLocations === 'Nationally'} onChange={this.handleLocationChange}  />
                                                                <label for="locations-2">Nationally</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div className="custom-radio">
                                                                <input type="radio" id="locations-3" value="Globally" name="radioDemo" checked={this.state.selectedLocations === 'Globally'} onChange={this.handleLocationChange} />
                                                                <label for="locations-3">Globally</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                                
                                                <li>	
                                                    <h4>Monthly Media Spend</h4>
                                                    <div class="progress-wrap">
                                                        <div id="slider" class="progress-slider"></div>
                                                        <div className="custom-check">
                                                            <i className="close-check"></i>
                                                            <div className="custom-chk">
                                                                <input type="checkbox" id="progress-chk-1" onChange={ this.handleProgressChecked } checked={progressCheckedVal} />
                                                                <label for="progress-chk-1">$10,000+</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                
                                                <li>
                                                    <h4>Do you require Banner Creatives? <span className="right" title="" data-tipso={bannerdata.banner_creatives_tooltip}><i><img src="<?php echo get_template_directory_uri();?>/assets/images/uplers-estimators/info-icon.svg" alt="" /></i></span></h4>
                                                    <ul className="custom-chk-round">
                                                        <li>
                                                            <div className="custom-radio">
                                                                <input type="radio" id="require-banner-1" value="yes" name="radioBanner" checked={this.state.selectedBannerOption === 'yes'} onChange={this.handleBannerChange} />
                                                                <label for="require-banner-1">Yes</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div className="custom-radio">
                                                                <input type="radio" id="require-banner-2" value="no" name="radioBanner" checked={this.state.selectedBannerOption === 'no'} onChange={this.handleBannerChange} />
                                                                <label for="require-banner-2">No</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>


                                                <li>
                                                    <h4>Do you require Landing Page? <span className="right" title="" data-tipso={bannerdata.landing_page_tooltip}><i><img src="<?php echo get_template_directory_uri();?>/assets/images/uplers-estimators/info-icon.svg" alt="" /></i></span></h4>
                                                    <ul className="custom-chk-round">
                                                        <li>
                                                            <div className="custom-radio">
                                                                <input type="radio" id="require-landing-1" value="yes" name="radioLanding" checked={this.state.selectedLandingOption === 'yes'} onChange={this.handleLandingChange} />
                                                                <label for="require-landing-1">Yes</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div className="custom-radio">
                                                                <input type="radio" id="require-landing-2" value="no" name="radioLanding" checked={this.state.selectedLandingOption === 'no'} onChange={this.handleLandingChange} />
                                                                <label for="require-landing-2">No</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>

                                            </ul>


                                        </div>
                                    </div>
                                    <div className="col-lg-5 col-md-12">
                                        <div className="estimate-summary">

                                            <div className="summary-title">
                                                <h3>Estimate Summary</h3>
                                            </div>
                                            {
                                                (this.state.isProgressChecked) ?
                                                    <h5>Monthly Media Spend for $10,000+</h5>
                                                :
                                                    <h5>Monthly Media Spend for ${monthlyMediaPrice}</h5>
                                            }
                                            
                                            <div className="summary-table month-summary">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th><span className="strong">Services</span></th>
                                                            <th><span className="strong">First<br/> Month</span></th>
                                                            <th><span className="strong">Next<br/> Month</span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        { //Check if Google Ads checked or not
                                                                (this.state.isGoogleAdsChecked)
                                                                  ?
                                                        <tr>
                                                            <td>Google Ads</td>
                                                            <td>${servicePrice}</td>
                                                            <td>${servicePrice}</td>
                                                        </tr>
                                                        : ''
                                                        }
                                                        { //Check if FbInsta Checked or not
                                                                (this.state.isFbInstaChecked)
                                                                  ?
                                                        <tr>
                                                            <td>Facebook &amp; Instagram Ads</td>
                                                            <td>${servicePrice}</td>
                                                            <td>${servicePrice}</td>
                                                        </tr>
                                                        : ''
                                                        }
                                                        { //Check if twitter ads checked or not
                                                                (this.state.isTwitterAdsChecked)
                                                                  ?
                                                        <tr>
                                                            <td>Twitter Ads</td>
                                                            <td>${servicePrice}</td>
                                                            <td>${servicePrice}</td>
                                                        </tr>
                                                        : ''
                                                        }
                                                        { //Check if Youtube ads checked or not
                                                                (this.state.isYoutubeAdsChecked)
                                                                  ?
                                                        <tr>
                                                            <td>YouTube Ads</td>
                                                            <td>${servicePrice}</td>
                                                            <td>${servicePrice}</td>
                                                        </tr>
                                                        : ''
                                                        }
                                                        { //Check if LinkedIn ads checked or not
                                                                (this.state.isLinkedInAdsChecked)
                                                                  ?
                                                        <tr>
                                                            <td>LinkedIn Ads</td>
                                                            <td>${servicePrice}</td>
                                                            <td>${servicePrice}</td>
                                                        </tr>
                                                        : ''
                                                        }
                                                        { //Check if Bings ads checked or not
                                                                (this.state.isBingAdsChecked)
                                                                  ?
                                                        <tr>
                                                            <td>Bing Ads</td>
                                                            <td>${servicePrice}</td>
                                                            <td>${servicePrice}</td>
                                                        </tr>
                                                        : ''
                                                        }
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3"><strong>Campaign Fee</strong></td>
                                                        </tr>
                                                        { //Check if Google Ads checked or not
                                                                (this.state.isGoogleAdsChecked)
                                                                  ?
                                                        <tr>
                                                            <td>Google Ads</td>
                                                            <td>${campaignPrice}</td>
                                                            <td>-</td>
                                                        </tr>
                                                        : ''
                                                        }
                                                        { //Check if FbInsta Checked or not
                                                                (this.state.isFbInstaChecked)
                                                                  ?
                                                        <tr>
                                                            <td>Facebook &amp; Instagram Ads</td>
                                                            <td>${campaignPrice}</td>
                                                            <td>-</td>
                                                        </tr>
                                                        : ''
                                                        }
                                                        { //Check if twitter ads checked or not
                                                            (this.state.isTwitterAdsChecked)
                                                                  ?
                                                            <tr>
                                                                <td>Twitter Ads</td>
                                                                <td>${campaignPrice}</td>
                                                                <td>-</td>
                                                            </tr>
                                                        : ''
                                                        }
                                                        { //Check if Youtube ads checked or not
                                                            (this.state.isYoutubeAdsChecked)
                                                                  ?
                                                            <tr>
                                                                <td>Youtube Ads</td>
                                                                <td>${campaignPrice}</td>
                                                                <td>-</td>
                                                            </tr>
                                                        : ''
                                                        }
                                                        { //Check if LinkedIn ads checked or not
                                                            (this.state.isLinkedInAdsChecked)
                                                                  ?
                                                            <tr>
                                                                <td>LinkedIn Ads</td>
                                                                <td>${campaignPrice}</td>
                                                                <td>-</td>
                                                            </tr>
                                                        : ''
                                                        }
                                                        { //Check if Bing ads checked or not
                                                            (this.state.isBingAdsChecked)
                                                                  ?
                                                            <tr>
                                                                <td>Bing Ads</td>
                                                                <td>${campaignPrice}</td>
                                                                <td>-</td>
                                                            </tr>
                                                        : ''
                                                        }
                                                        
                                                        { //Check if Bing ads checked or not
                                                            (selectedBannerOption == "yes")
                                                                  ?
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                        </tr> 
                                                        : ''
                                                        }
                                                        { //Check if Bing ads checked or not
                                                            (selectedBannerOption == "yes")
                                                                  ?
                                                        <tr>
                                                            <td><strong>For Banners</strong></td>
                                                            <td><strong>${bannerPrice}</strong></td>
                                                            <td><strong>-</strong></td>
                                                        </tr>
                                                        : ''
                                                        }
                                                        
                                                        { //Check if Bing ads checked or not
                                                            (selectedLandingOption == "yes")
                                                                  ?
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                        </tr> 
                                                        : ''
                                                        }
                                                        { //Check if Bing ads checked or not
                                                            (selectedLandingOption == "yes")
                                                                  ?
                                                        <tr>
                                                            <td><strong>For Landing Page</strong></td>
                                                            <td><strong>${landingPrice}</strong></td>
                                                            <td><strong>-</strong></td>
                                                        </tr>
                                                        : ''
                                                        }
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td>Total</td>
                                                            { (firstMonthTotal != "")?    
                                                                <td>${firstMonthTotal}</td>
                                                            : <td>$0</td>
                                                            }
                                                            { (serviceTotal != "")?    
                                                                <td>${serviceTotal}</td>
                                                            : <td>$0</td>
                                                            }
                                                            
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>


                                            <form onSubmit={this.handleSubmit} method="post">
                                                <div className="custom-swich-chk">
                                                    <input type="checkbox" id="estimate-check" onChange={ this.handleRequestChecked } checked={requestCheckedVal} />
                                                    <label for="estimate-check"></label>
                                                    <span>Request a Quote</span> 
                                                </div>
                                                {
                                                    (this.state.isRequestChecked)?
                                                <div className="row">
                                                    <div className="col-lg-6">
                                                        <div className="feild">
                                                            <input type="text" name="fullname" value={this.state.fullname} onChange={this.onChange} placeholder="Full name*" required="required" />
                                                        </div>
                                                    </div>
                                                    <div className="col-lg-6">
                                                        <div className="feild">
                                                            <input type="email" name="email" value={this.state.email} onChange={this.onChange} placeholder="Email*" required="required" />
                                                        </div>
                                                    </div>
                                                    <div className="col-lg-6">
                                                        <div className="feild">
                                                            <input type="tel" name="phone" value={this.state.phone} onChange={this.onChange} placeholder="Phone*" required="required" />
                                                        </div>
                                                    </div>
                                                    <div className="col-lg-6">
                                                        <div className="feild">
                                                            <input type="text" name="website" value={this.state.website} onChange={this.onChange} placeholder="Website" />
                                                        </div>
                                                    </div>
                                                    <div className="col-lg-12">
                                                        <div className="feild">
                                                            <textarea name="comments" value={this.state.comments} onChange={this.onChange} placeholder="Description"></textarea>
                                                        </div>
                                                    </div>
                                                    <div className="col-lg-12">
                                                        <div className="feild submit-wrap">
                                                            <input type="submit" name="submit" value="submit" />
                                                            {
                                                                (this.state.loading)?
                                                                <span className="spinner"></span>
                                                                : ""
                                                            }
                                                        </div>
                                                    </div>
                                                    { (!this.state.errorMessage)
                                                        ?
                                                        <span className="suceessmsg"> { this.state.successMessage } </span>
                                                        :
                                                        <span className="errormsg"> { this.state.errorMessage }</span>
                                                    }
                                                    
                                                </div>
                                                : ''
                                                }
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </section>

                    <section className="paging">
                        <div className="row">
                                <div className="col-sm-4 pagename-box animated fadeInLeft">
                                        <a href={bannerdata.button_link_first} >
                                                <h3 class="title">{bannerdata.button_label_first}</h3>
                                        </a>
                                </div>
                                <div className="col-sm-4 pagename-box animated fadeInLeft">
                                        <a href={bannerdata.button_link_second} >
                                                <h3 class="title">{bannerdata.button_label_second}</h3>
                                        </a>
                                </div>
                                <div className="col-sm-4 pagename-box animated fadeInLeft">
                                        <a href={bannerdata.button_link_third} >
                                                <h3 class="title">{bannerdata.button_label_third}</h3>
                                        </a>
                                </div>
                        </div>
                    </section>

                </div>
            );
        }
    }
    ReactDOM.render(<SemEstimatorForm />, document.getElementById('main'));
    </script>
<?php get_footer(); ?>
