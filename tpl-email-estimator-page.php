<?php
/**
 * Template Name: Email Estimator
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
<script src="https://unpkg.com/react@16/umd/react.production.min.js" defer></script>
<script src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js" defer></script>
<script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js" defer></script>
<script src="https://unpkg.com/axios/dist/axios.min.js" defer></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js" defer></script>
<script src="<?php echo get_template_directory_uri();?>/assets/js/tipso.js"></script>
<div id="main" class="wrapper"></div>
<script type="text/babel">
    class EmailEstimatorForm extends React.Component {
        constructor(props) {
            super(props);
            this.state = {
                loading : false,
                isLoading: true,
                websites: [{website: ""}],
                industries: [{industry: ""}],
                bannerdata: [],
                selectedContentOption: 'withcontent',
                isRequestChecked: false,
                isConfirmChecked: false,
                isSureChecked: false,
                selectedLinks : 'less',
                numberCountOne : 1,
                numberCountTwo : 0,
                numberCountThree : 0,
                numberCountFour : 0,     
                estimatordata : {
                    url:"<?php echo site_url();?>/wp-json/acf/v3/pages/<?php echo get_the_ID();?>/",
                    method:"GET",
                },
            };
            this.handleLinksChange = this.handleLinksChange.bind(this);
            this.handleContentOptionChange = this.handleContentOptionChange.bind(this);
            this.handleRequestChecked = this.handleRequestChecked.bind(this); // set this, because you need get methods from CheckBox
            this.handleConfirmChecked = this.handleConfirmChecked.bind(this); // set this, because you need get methods from CheckBox
            this.handleSureChecked= this.handleSureChecked.bind(this); // set this, because you need get methods from CheckBox
        }
        getDataLists = (estimatordata) => {
                fetch(this.state.estimatordata.url,{
                       method:this.state.estimatordata.method
                    }).then(res => {
                       return res.json()
                    }).then(data => {                        
                        this.setState({ bannerdata: data.acf, isLoading: false, })                       
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
			jQuery("#chk-popup").click(function(){
			    jQuery(".mfp-close").trigger("click");
			
                setTimeout(function(){
                    jQuery("#content-chk-2").prop("checked","true");
                    $this.setState({selectedContentOption: "withoutcontent"});
                
                },100);
                setTimeout(function(){
                    jQuery("#chk-popup").prop("checked",false);
                },1500)
			
			})
			
			jQuery('a.deadline-popup').magnificPopup({
                removalDelay: 500, //delay removal by X to allow out-animation
                callbacks: {
                beforeOpen: function() {
                    this.st.mainClass = this.st.el.attr('data-effect');
                },
                open: function() {
                    jQuery("#chk-popup").prop("checked",false);
                }
                },
                midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
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
				
             {/***************right side tooltip start********************/}
             jQuery('.right').tipso({
				position: 'right', 
				background: 'rgba(0,0,0,0.8)',
				useTitle: false,
			});
            
         }
         handleLinksChange = (e) => {
            this.setState({
              selectedLinks : e.target.value,
            });            
        }
        handleSureChecked() {
            this.setState({isSureChecked: !this.state.isSureChecked});
        }
        handleRequestChecked () {
            this.setState({isRequestChecked: !this.state.isRequestChecked});
        }
        handleConfirmChecked () {
            this.setState({isConfirmChecked: !this.state.isConfirmChecked});
        }
        handleContentOptionChange = (e) => {
            this.setState({
              selectedContentOption : e.target.value,
            });            
        }   
        onclick(type){
            this.setState(prevState => {                
                {/****************<40 number of count Start***************************/}                
                    if(prevState.numberCountOne >= 0 && type == 'addOne'){ 
                        return {numberCountOne: type == 'addOne' ? prevState.numberCountOne + 1: prevState.numberCountOne - 1}
                    }else if(prevState.numberCountOne > 0 && type == 'subOne'){
                        return {numberCountOne: type == 'addOne' ? prevState.numberCountOne + 1: prevState.numberCountOne - 1}
                    }                
                {/****************<40 number of count End*****************************/}   
                
                {/****************41 to 60 number of count Start***************************/}                
                    if(prevState.numberCountTwo >= 0 && type == 'addTwo'){ 
                        return {numberCountTwo: type == 'addTwo' ? prevState.numberCountTwo + 1: prevState.numberCountTwo - 1}
                    }else if(prevState.numberCountTwo > 0 && type == 'subTwo'){
                        return {numberCountTwo: type == 'addTwo' ? prevState.numberCountTwo + 1: prevState.numberCountTwo - 1}
                    }                
                {/****************41 to 60 number of count End*****************************/}   
                
                {/****************61 to 69 number of count Start***************************/}                
                    if(prevState.numberCountThree >= 0 && type == 'addThree'){ 
                        return {numberCountThree: type == 'addThree' ? prevState.numberCountThree + 1: prevState.numberCountThree - 1}
                    }else if(prevState.numberCountThree > 0 && type == 'subThree'){
                        return {numberCountThree: type == 'addThree' ? prevState.numberCountThree + 1: prevState.numberCountThree - 1}
                    }                
                {/****************61 to 69 number of count End*****************************/}   
                
                {/****************<70 number of count Start***************************/}                
                    if(prevState.numberCountFour >= 0 && type == 'addFour'){ 
                        return {numberCountFour: type == 'addFour' ? prevState.numberCountFour + 1: prevState.numberCountFour - 1}
                    }else if(prevState.numberCountFour > 0 && type == 'subFour'){
                        return {numberCountFour: type == 'addFour' ? prevState.numberCountFour + 1: prevState.numberCountFour - 1}
                    }                
                {/****************<70 number of count End*****************************/}   
               
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
        
        addWebsiteClick(){
            this.setState(prevState => ({ 
                websites: [...prevState.websites, { website: ""}]
            }))
        }
        removeWebsiteClick(i){
            let websites = [...this.state.websites];
            websites.splice(i, 1);
            this.setState({ websites });
        }
        handleWebsiteChange(i, e) {
            const { name, value } = e.target;
            let websites = [...this.state.websites];
            websites[i] = {...websites[i], [name]: value};
            this.setState({ websites });
        }
        createWebsiteUI(){
            return this.state.websites.map((el, i) => (
                <div className="feild-plus" key={i}>                                                                
                    <input type="text" name="website" value={el.website ||''} onChange={this.handleWebsiteChange.bind(this, i)} placeholder="Website" />
                    <button className="remove remove_website_button"   type="button"><i className="zmdi zmdi-minus" onClick={this.removeWebsiteClick.bind(this, i)}>-</i></button>
                    <button className="add add_font_button add_website_button" type="button"><i className="zmdi zmdi-plus" onClick={this.addWebsiteClick.bind(this)}>+</i></button>
                </div> 
            ))
        }   
        addIndustryClick(){
            this.setState(prevState => ({ 
                industries: [...prevState.industries, { industry: ""}]
            }))
        }
        removeIndustryClick(i){
            let industries = [...this.state.industries];
            industries.splice(i, 1);
            this.setState({ industries });
        }
        handleIndustryChange(i, e) {
            const { name, value } = e.target;
            let industries = [...this.state.industries];
            industries[i] = {...industries[i], [name]: value};
            this.setState({ industries });
        }
        createIndustryUI(){
            return this.state.industries.map((el, i) => (
                <div className="feild-plus" key={i}>
                    <input type="text" name="industry" value={el.industry ||''} onChange={this.handleIndustryChange.bind(this, i)} placeholder="Industry" />
                    <button className="remove remove_industry_button" type="button"><i className="zmdi zmdi-minus" onClick={this.removeIndustryClick.bind(this, i)}>-</i></button>
                    <button className="add add_font_button add_industry_button" type="button"><i className="zmdi zmdi-plus" onClick={this.addIndustryClick.bind(this)}>+</i></button>
                </div>
            ))
        }        
        
        handleSubmit = e => {
            e.preventDefault();
            this.setState({ loading : true });
            let formData = {};
            let webdata = [];            
            let indata = [];   
            this.state.websites.map((item,index)=>{
                webdata.push(item.website)
            });
            this.state.industries.map((item,index)=>{
                indata.push(item.industry)
            });
            formData = {
                websites:webdata,
                industries : indata,
                fullname : this.state.fullname,
                email : this.state.email,
                phone : this.state.phone,
                comments : this.state.comments,
                selectedLinksData : this.state.selectedLinks,
                conetents : this.state.selectedContentOption,
                isSureChecked: this.state.isSureChecked,
                preferredDaOne : JSON.parse(CryptoJS.AES.decrypt(this.actionInputpreferredDaOne.value, 'my-secret-key@123').toString(CryptoJS.enc.Utf8)),
                preferredDaTwo : JSON.parse(CryptoJS.AES.decrypt(this.actionInputpreferredDaTwo.value, 'my-secret-key@123').toString(CryptoJS.enc.Utf8)),
                preferredDaThree : JSON.parse(CryptoJS.AES.decrypt(this.actionInputpreferredDaThree.value, 'my-secret-key@123').toString(CryptoJS.enc.Utf8)),
                preferredDaFour : JSON.parse(CryptoJS.AES.decrypt(this.actionInputpreferredDaFour.value, 'my-secret-key@123').toString(CryptoJS.enc.Utf8)),
                totalPrice : JSON.parse(CryptoJS.AES.decrypt(this.actionInputtotalPrice.value, 'my-secret-key@123').toString(CryptoJS.enc.Utf8)),
            }
            axios({
                method: 'post',
                url: '<?php echo get_template_directory_uri();?>/hubspot/email-estimator-hubspot.php',
                data: formData,
                dataType : JSON,
            }).then((response) => {
                this.setState({ successMessage : 'Thank you for contating us!' });
                this.setState({fullname: '', email: '', phone: '', comments:'', loading : false}) // <= here
                setTimeout(() => this.setState({successMessage:''}), 5000);
            }, (error) => {
                this.setState({ errorMessage : 'There was an error!' });
                this.setState({ loading : false}) // <= clear form input here
                setTimeout(() => this.setState({errorMessage: ''}), 5000);
            });
        };
        render() {
            const {loading ,isLoading, bannerdata, selectedLinks, selectedContentOption, numberCountOne, isSureChecked, isConfirmChecked, isRequestChecked, fullname, email, phone, website, comments, numberCountTwo, numberCountThree, numberCountFour} = this.state;
            var totalPrice, preferredDaOne, preferredDaTwo, preferredDaThree, preferredDaFour, requestCheckedVal, sureCheckedVal, confirmCheckedVal, confirmClass; 
                {/*********************Request Quote Checked Start*****************************/}
                  
                    if (this.state.isSureChecked) {
                        sureCheckedVal="checked";
                    } else {
                        sureCheckedVal="";
                    }
                    if (this.state.isConfirmChecked) {
                        confirmCheckedVal="checked";
                        confirmClass="closePopups";
                    } else {
                        confirmCheckedVal="";
                        confirmClass="";
                    }
                    if (this.state.isRequestChecked) {
                        requestCheckedVal="checked";
                    } else {
                        requestCheckedVal="";
                    }    
                {/**********************Request Quote Checked End******************************/}   
                {/*********************Check links per more than 50 or not Start*****************************/}
                    if(selectedLinks == "less" && selectedContentOption == "withcontent"){
                        preferredDaOne = Number(numberCountOne) * Number(bannerdata.preferred_da_less_withcontent_one);
                        preferredDaTwo = Number(numberCountTwo) * Number(bannerdata.preferred_da_less_withcontent_two);
                        preferredDaThree = Number(numberCountThree) * Number(bannerdata.preferred_da_less_withcontent_three);
                        preferredDaFour = Number(numberCountFour) * Number(bannerdata.preferred_da_less_withcontent_four);
                        totalPrice = Number(preferredDaOne) + Number(preferredDaTwo) + Number(preferredDaThree) + Number(preferredDaFour) ;
                    } else if(selectedLinks == "less" && selectedContentOption == "withoutcontent"){
                        preferredDaOne = Number(numberCountOne) * Number(bannerdata.preferred_da_less_perlink_one);
                        preferredDaTwo = Number(numberCountTwo) * Number(bannerdata.preferred_da_less_perlink_two);
                        preferredDaThree = Number(numberCountThree) * Number(bannerdata.preferred_da_less_perlink_three);
                        preferredDaFour = Number(numberCountFour) * Number(bannerdata.preferred_da_less_perlink_four);
                        totalPrice = Number(preferredDaOne) + Number(preferredDaTwo) + Number(preferredDaThree) + Number(preferredDaFour) ;
                    } else if(selectedLinks == "more" && selectedContentOption == "withcontent"){
                        preferredDaOne = Number(numberCountOne) * Number(bannerdata.preferred_da_more_withcontent_one);
                        preferredDaTwo = Number(numberCountTwo) * Number(bannerdata.preferred_da_more_withcontent_two);
                        preferredDaThree = Number(numberCountThree) * Number(bannerdata.preferred_da_more_withcontent_three);
                        preferredDaFour = Number(numberCountFour) * Number(bannerdata.preferred_da_more_withcontent_four);
                        totalPrice = Number(preferredDaOne) + Number(preferredDaTwo) + Number(preferredDaThree) + Number(preferredDaFour) ;
                    } else if(selectedLinks == "more" && selectedContentOption == "withoutcontent"){
                        preferredDaOne = Number(numberCountOne) * Number(bannerdata.preferred_da_more_perlink_one);
                        preferredDaTwo = Number(numberCountTwo) * Number(bannerdata.preferred_da_more_perlink_two);
                        preferredDaThree = Number(numberCountThree) * Number(bannerdata.preferred_da_more_perlink_three);
                        preferredDaFour = Number(numberCountFour) * Number(bannerdata.preferred_da_more_perlink_four);
                        totalPrice = Number(preferredDaOne) + Number(preferredDaTwo) + Number(preferredDaThree) + Number(preferredDaFour) ;
                    }
                    if(totalPrice>0){
                        totalPrice=totalPrice;
                    } else {
                        totalPrice="0";
                    }
                    if(preferredDaOne>0){
                        preferredDaOne=preferredDaOne;
                    } else {
                        preferredDaOne="0";
                    }
                    if(preferredDaTwo>0){
                        preferredDaTwo=preferredDaTwo;
                    } else {
                        preferredDaTwo = "0";
                    }
                    
                    if(preferredDaThree>0){
                        preferredDaThree=preferredDaThree;
                    } else {
                        preferredDaThree="0";
                    }
                    
                    if(preferredDaFour>0){
                        preferredDaFour=preferredDaFour;
                    } else {
                        preferredDaFour="0";
                    }

                        
                {/*********************Check links per more than 50 or not End*******************************/}
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
                                                    <h4>Links per month</h4>
                                                    <ul className="custom-chk-round">
                                                        <li>
                                                            <div className="custom-radio">
                                                                <input type="radio" id="month-1" name="radioLink" value="less" checked={this.state.selectedLinks === 'less'} onChange={this.handleLinksChange} />
                                                                <label for="month-1">Less than 50</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div className="custom-radio">
                                                                <input type="radio" id="month-2" name="radioLink" value="more" checked={this.state.selectedLinks === 'more'} onChange={this.handleLinksChange} />
                                                                <label for="month-2">More than 50</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <h4>Please provide the preferred DA <span className="right" title="" data-tipso={bannerdata.preferred_da_tooltip}><i><img src="<?php echo get_template_directory_uri();?>/assets/images/uplers-estimators/info-icon.svg" alt="" /></i></span></h4>
                                                    <ul className="number-counter-listing bg-counter">
                                                        <li>
                                                            <div className="number-counter handleCounter">
                                                                <input type="text" name="UniquePage" className="qtyBox" value={numberCountOne} min="1" />
                                                                <span> &lt;40</span>
                                                                <div className="value-button counter-plus" onClick={this.onclick.bind(this, 'addOne')}> <i className="caret-up"><img src="<?php echo get_template_directory_uri();?>/assets/images/uplers-estimators/caret-up-icon.svg" alt=""/></i> </div>
                                                                <div className="value-button counter-minus" onClick={this.onclick.bind(this, 'subOne')}> <i className="caret-down"><img src="<?php echo get_template_directory_uri();?>/assets/images/uplers-estimators/caret-down-icon.svg" alt=""/></i> </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div className="number-counter handleCounter1">
                                                                <input type="text" name="UniquePage" className="qtyBox" value={numberCountTwo} min="1" />
                                                                <span>41 to 60</span>
                                                                <div className="value-button counter-plus" onClick={this.onclick.bind(this, 'addTwo')}> <i className="caret-up"><img src="<?php echo get_template_directory_uri();?>/assets/images/uplers-estimators/caret-up-icon.svg" alt=""/></i> </div>
                                                                <div className="value-button counter-minus" onClick={this.onclick.bind(this, 'subTwo')}> <i className="caret-down"><img src="<?php echo get_template_directory_uri();?>/assets/images/uplers-estimators/caret-down-icon.svg" alt=""/></i> </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div className="number-counter handleCounter1">
                                                                <input type="text" name="UniquePage" className="qtyBox" value={numberCountThree} min="1" />
                                                                <span>61 to 69</span>
                                                                <div className="value-button counter-plus" onClick={this.onclick.bind(this, 'addThree')}> <i className="caret-up"><img src="<?php echo get_template_directory_uri();?>/assets/images/uplers-estimators/caret-up-icon.svg" alt=""/></i> </div>
                                                                <div className="value-button counter-minus" onClick={this.onclick.bind(this, 'subThree')}> <i className="caret-down"><img src="<?php echo get_template_directory_uri();?>/assets/images/uplers-estimators/caret-down-icon.svg" alt=""/></i> </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div className="number-counter handleCounter">
                                                                <input type="text" name="UniquePage" className="qtyBox" value={numberCountFour} min="1" />
                                                                <span> &gt;70</span>
                                                                <div className="value-button counter-plus" onClick={this.onclick.bind(this, 'addFour')}> <i className="caret-up"><img src="<?php echo get_template_directory_uri();?>/assets/images/uplers-estimators/caret-up-icon.svg" alt=""/></i> </div>
                                                                <div className="value-button counter-minus" onClick={this.onclick.bind(this, 'subFour')}> <i className="caret-down"><img src="<?php echo get_template_directory_uri();?>/assets/images/uplers-estimators/caret-down-icon.svg" alt=""/></i> </div>
                                                            </div>
                                                        </li>
                                                        <li className="custom-check not-sure-check">
															<i className="close-check"></i>
															<div className="custom-chk">
															<input type="checkbox" id="not-sure" onChange={ this.handleSureChecked } checked={sureCheckedVal} />
															<label for="not-sure">I’m not sure</label>
															</div>
														</li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <h4>We will write the content</h4>
                                                    <ul className="custom-chk-round">
                                                        <li>
														    <div className="custom-radio">
                                                                <input type="radio" id="content-chk-1" name="radioContent" value="withcontent" checked={this.state.selectedContentOption === 'withcontent'} onChange={this.handleContentOptionChange} />
                                                                <label for="content-chk-1">Yes</label>
                                                            </div>
														</li>
                                                        <li>
														<a className="deadline-popup" href="#deadline-popup" onChange={this.handleContentOptionChange}>
                                                            <div className="custom-radio">
                                                                <input type="radio" id="content-chk-2" name="radioContent" value="withoutcontent" checked={this.state.selectedContentOption === 'withoutcontent'} onChange={this.handleContentOptionChange} />
                                                                <label for="content-chk-2">No, I will provide the content</label>
                                                            </div>
															</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
										<div id="deadline-popup" className="white-popup mfp-with-anim mfp-hide">
										<div className="speedometer-img"><img src="<?php echo get_template_directory_uri();?>/assets/images/uplers-estimators/speedometer-img.png" alt="" /></div>
												<h3>{bannerdata.popup_content}</h3>
													<div className="custom-chk-round">
                                                        <div className="custom-chk">
                                                            <input type="checkbox" id="chk-popup" value="1" name="radioLink" onChange={ this.handleConfirmChecked } checked={confirmCheckedVal} />
                                                            <label for="chk-popup">I confirm, we will provide the content quickly.</label>
                                                        </div>
													</div>
										</div>
                                    </div>
                                    <div className="col-lg-5 col-md-12">
                                        <div className="estimate-summary">
                                            <div className="summary-title">
                                                <h3>Estimate Summary</h3>
                                            </div>
                                            <div className="summary-table">
                                                <table>
                                                    <thead>
                                                        {
                                                            (this.state.selectedContentOption === 'withcontent')
                                                            ? <tr><th>Links with Content</th> <th>&nbsp;</th></tr>
                                                            : ""
                                                        }
                                                        {
                                                            (this.state.selectedContentOption === 'withoutcontent')
                                                            ? <tr><th>Links without Content</th> <th>&nbsp;</th></tr>
                                                            : ""
                                                        }
                                                        
                                                    </thead>
                                                    <tbody>
                                                        { //Check if <40DA less then 0
                                                            (this.state.numberCountOne > 0)
                                                              ? <tr> <td>&lt;40 DA * {numberCountOne} links</td> <td>$ {preferredDaOne}</td> </tr>
                                                              : ''
                                                        }
                                                        { //Check if 41 to 60DA less then 0
                                                            (this.state.numberCountTwo > 0)
                                                              ? <tr> <td>41 to 60 DA * {numberCountTwo} links</td> <td>$ {preferredDaTwo}</td> </tr>
                                                              : ''
                                                        }
                                                        { //Check if 31 to 69DA less then 0
                                                            (this.state.numberCountThree > 0)
                                                              ? <tr> <td>61 to 69 DA * {numberCountThree} links</td> <td>$ {preferredDaThree}</td> </tr>
                                                              : ''
                                                        }
                                                        { //Check if >70DA less then 0
                                                            (this.state.numberCountFour > 0)
                                                              ? <tr> <td>&gt;70 DA * {numberCountFour} links</td> <td>$ {preferredDaFour}</td> </tr>
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
                                                            <td>${totalPrice}</td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <form onSubmit={this.handleSubmit} method="post">
                                                <div className="custom-swich-chk">
                                                    <input type="checkbox" id="estimate-check" onChange={ this.handleRequestChecked } checked={requestCheckedVal} />
                                                    <label for="estimate-check"></label>
                                                    <span>Request a Quote</span> </div>
                                                {
                                                (this.state.isRequestChecked)?
                                                <div className="row">
                                                <div className="col-lg-6">
                                                        <div className="feild font_fields_wrap website_fields_wrap webcount">
                                                            {this.createWebsiteUI()} 
														</div>
                                                    </div>
                                                    <div className="col-lg-6">
                                                        <div className="feild font_fields_wrap industry_fields_wrap incount">
                                                            {this.createIndustryUI()}                                                            
                                                        </div>
                                                    </div>
                                                    <div className="col-lg-6">
                                                        <div className="feild">
                                                            <input type="text" name="fullname" value={this.state.fullname} onChange={this.onChange} placeholder="Full name*" required="required"/>
                                                        </div>
                                                    </div>
                                                    <div className="col-lg-6">
                                                        <div className="feild">
                                                            <input type="number" name="phone" value={this.state.phone} onChange={this.onChange} placeholder="Phone*" required="required" />
                                                        </div>
                                                    </div>
                                                    <div className="col-lg-12">
                                                        <div className="feild">
                                                            <input type="email" name="email" value={this.state.email} onChange={this.onChange} placeholder="Email*" required="required"/>
                                                        </div>
                                                    </div>
                                                    <div className="col-lg-12">
                                                        <div className="feild">
                                                            <textarea name="comments" value={this.state.comments} onChange={this.onChange} placeholder="Description"></textarea>
                                                        </div>
                                                    </div>
                                                    <div className="col-lg-12">
                                                        <div className="feild submit-wrap">
                                                            <input type="hidden" name="preferredDaOne" value={CryptoJS.AES.encrypt(JSON.stringify(preferredDaOne), 'my-secret-key@123').toString()} ref={(input) => { this.actionInputpreferredDaOne = input }}/>
                                                            <input type="hidden" name="preferredDaTwo" value={CryptoJS.AES.encrypt(JSON.stringify(preferredDaTwo), 'my-secret-key@123').toString()} ref={(input) => { this.actionInputpreferredDaTwo = input }}/>
                                                            <input type="hidden" name="preferredDaThree" value={CryptoJS.AES.encrypt(JSON.stringify(preferredDaThree), 'my-secret-key@123').toString()} ref={(input) => { this.actionInputpreferredDaThree = input }}/>
                                                            <input type="hidden" name="preferredDaFour" value={CryptoJS.AES.encrypt(JSON.stringify(preferredDaFour), 'my-secret-key@123').toString()} ref={(input) => { this.actionInputpreferredDaFour = input }}/>
                                                            <input type="hidden" name="totalPrice" value={CryptoJS.AES.encrypt(JSON.stringify(totalPrice), 'my-secret-key@123').toString()} ref={(input) => { this.actionInputtotalPrice = input }}/>
                                                            <input type="submit" name="submit" value="submit" />
                                                            {
                                                                (this.state.loading)?
                                                                <span className="spinner"></span>
                                                                : ""
                                                            }
                                                        </div>
                                                        { (!this.state.errorMessage)
                                                        ?
                                                        <span className="suceessmsg"> { this.state.successMessage } </span>
                                                        :
                                                        <span className="errormsg"> { this.state.errorMessage }</span>
                                                    }
                                                        
                                                    </div>
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
    ReactDOM.render(<EmailEstimatorForm />, document.getElementById('main'));
</script>

<?php get_footer(); ?>

