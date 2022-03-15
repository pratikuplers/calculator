<?php
/**
 * Template Name: Quote Request Page Template
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
get_header();
?>
<script src="https://unpkg.com/react@16/umd/react.production.min.js" defer></script>
<script src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js" defer></script>
<script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js" defer></script>
<script src="https://unpkg.com/axios/dist/axios.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js" defer></script>
<script src="<?php echo get_template_directory_uri();?>/assets/js/tipso.js" defer></script>
<div id="main" class="wrapper"></div>
<script type="text/babel">    
    class QuoteForm extends React.Component {
        constructor(props) {
            super(props);
            this.state = {
                loading : false,
                isLoading: true,
                hasFullnameError:false,
                selectedFile: null,
                hasEmailError:false,
                hasPhoneError:false,
                bannerdata: [],
                count: 0,
                isChecked: false,
                isVChecked: false,
                isRequestChecked: false,
                homecount:0,
                adaptioncount: 0,
                componentcount: 0,
                bloglistingcount: 0,
                blogdetailcount: 0,
                error: null,
                selectedTechnology : '',
                selectedService : '',
                selectedSeo : '',
                invalid: true,
                selectedPackage : '',
                invalid:false,
                quotedata : {
                          url:"<?php echo site_url();?>/wp-json/acf/v3/pages/<?php echo get_the_ID();?>/",
                          method:"GET",
                    },
                
            };
            this.handleChecked = this.handleChecked.bind(this); // set this, because you need get methods from CheckBox 
            this.handleVChecked = this.handleVChecked.bind(this); // set this, because you need get methods from CheckBox
            this.handleRequestChecked = this.handleRequestChecked.bind(this); // set this, because you need get methods from CheckBox
            this.handleTechnologyChange = this.handleTechnologyChange.bind(this);
            this.handleServiceChange = this.handleServiceChange.bind(this);
            this.handleSeoChange = this.handleSeoChange.bind(this);
            this.handlePackageChange = this.handlePackageChange.bind(this);
        }   
        
        getDataLists = (quotedata) => {
                fetch(this.state.quotedata.url,{
                       method:this.state.quotedata.method
                    }).then(res => {
                       return res.json()
                    }).then(data => {                        
                        this.setState({ bannerdata: data.acf, isLoading: false, })                       
                     })
                     .catch(error => this.setState({ error, isLoading: false }));
         }
        
         componentDidMount() {            
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
                {/***************custom checkbox START********************/}
                jQuery(".custom-check input[type='checkbox']").on("click tap", function () {
                    jQuery(this).parents('li').toggleClass('open');
                    jQuery(this).prop('readonly', true);
                });
                jQuery(".close-check").on("click tap", function () {
                    jQuery(this).parents('.custom-check').removeClass('open');
                    jQuery(this).parents('.custom-check').find("input").prop({disabled: false, checked: false});
                });
                {/***************custom checkbox END********************/}
                
        }      
        handlePackageChange = (e) => {
            this.setState({
              selectedPackage : e.target.value,
            });            
        }
        handleTechnologyChange = (e) => {
            this.setState({
              selectedTechnology : e.target.value,
            });            
        }
        handleSeoChange = (e) => {
            this.setState({
              selectedSeo : e.target.value,
            });            
        }
        handleServiceChange = (e) => {
            this.setState({
              selectedService : e.target.value,
            }); 
        }
        handleChecked () {
            this.setState({isChecked: !this.state.isChecked});
        }
        handleVChecked () {
            this.setState({isVChecked: !this.state.isVChecked});
        }
        handleRequestChecked () {
            this.setState({isRequestChecked: !this.state.isRequestChecked});
        }
        
        onclick(type){
            this.setState(prevState => {                
                {/****************Home component number Start***************************/}
                if(prevState.homecount >= 0 && type == 'addHome'){ 
                    return {homecount: type == 'addHome' ? 1: prevState.homecount - 1}
                }else if(prevState.homecount > 0 && type == 'subHome'){
                    return {homecount: type == 'addHome' ? prevState.homecount + 1: prevState.homecount - 1}
                }
                {/****************Home component number End*****************************/}
                
                {/****************Unique/ Inner number Start**********************/}
                if(prevState.count >= 0 && type == 'add'){ 
                    return {count: type == 'add' ? prevState.count + 1: prevState.count - 1}
                }else if(prevState.count > 0 && type == 'sub'){
                    return {count: type == 'add' ? prevState.count + 1: prevState.count - 1}
                }
                {/****************Unique/ Inner number End**********************/}
                
                {/****************Adaption number Start***************************/}
                if(prevState.adaptioncount > 0 && type == 'subadaption'){
                    return {adaptioncount: type == 'addadaption' ? prevState.adaptioncount + 1: prevState.adaptioncount - 1}
                }else if(prevState.count >= 0 && type == 'addadaption'){
                    return {adaptioncount: type == 'addadaption' ? prevState.adaptioncount + 1: prevState.adaptioncount - 1}
                }
                {/****************Increase/ Decrease number End******************************/}
                
                {/****************Interactive component number Start***************************/}
                if(prevState.componentcount > 0 && type == 'subcomponent'){
                    return {componentcount: type == 'addcomponent' ? prevState.componentcount + 1: prevState.componentcount - 1}
                }else if(prevState.count >= 0 && type == 'addcomponent'){
                    return {componentcount: type == 'addcomponent' ? prevState.componentcount + 1: prevState.componentcount - 1}
                }
                {/****************Interactive component number End***************************/}
                
                
                {/****************Blog Listing number Start***************************/}
                if(prevState.bloglistingcount > 0 && type == 'subBloglisting'){
                    return {bloglistingcount: type == 'addBloglisting' ? prevState.bloglistingcount + 1: prevState.bloglistingcount - 1}
                }else if(prevState.bloglistingcount >= 0 && type == 'addBloglisting'){
                    return {bloglistingcount: type == 'addBloglisting' ? prevState.bloglistingcount + 1: prevState.bloglistingcount - 1}
                }
                {/****************Blog Listing number End***************************/}
                
                {/****************Blog Detail number Start***************************/}
                if(prevState.blogdetailcount > 0 && type == 'subBlogdetail'){
                    return {blogdetailcount: type == 'addBlogdetail' ? prevState.blogdetailcount + 1: prevState.blogdetailcount - 1}
                }else if(prevState.blogdetailcount >= 0 && type == 'addBlogdetail'){
                    return {blogdetailcount: type == 'addBlogdetail' ? prevState.blogdetailcount + 1: prevState.blogdetailcount - 1}
                }
                {/****************Blog Detail number End***************************/}
            });
        }
        onChangeFileHandler=event=>{
            this.setState({
                /**previewselectedFile: URL.createObjectURL(event.target.files[0]),**/
                selectedFile: event.target.files[0]
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
            let formData = new FormData();
            formData.append("image", this.state.selectedFile);
            formData.append('selectedTechnology', this.state.selectedTechnology);
            formData.append('selectedService' , this.state.selectedService);
            formData.append('hometemp' , this.state.homecount);
            formData.append('uniquetemp' ,  this.state.count);
            formData.append('adaptiontemp', this.state.adaptioncount);
            formData.append('bloglisttemp', this.state.bloglistingcount);
            formData.append('blogdetailtemp', this.state.blogdetailcount);
            formData.append('interactivecomponentaddon', this.state.componentcount);
            formData.append('seoservice', this.state.selectedSeo);
            formData.append('selectpckge', this.state.selectedPackage);
            formData.append('fullname', this.state.fullname);
            formData.append('email', this.state.email);
            formData.append('phone', this.state.phone);
            formData.append('website', this.state.website);
            formData.append('comments', this.state.comments);
            formData.append('addlink', this.state.addlink);
            formData.append('radioDemo', this.state.radioDemo);

            formData.append('homeTemplatePrice', JSON.parse(CryptoJS.AES.decrypt(this.actionInputhomeTemplatePrice.value, 'my-secret-key@123').toString(CryptoJS.enc.Utf8)));
            formData.append('blogListingTemplatePrice', JSON.parse(CryptoJS.AES.decrypt(this.actionInputblogListingTemplatePrice.value, 'my-secret-key@123').toString(CryptoJS.enc.Utf8)));
            formData.append('blogDetailTemplatePrice', JSON.parse(CryptoJS.AES.decrypt(this.actionInputblogDetailTemplatePrice.value, 'my-secret-key@123').toString(CryptoJS.enc.Utf8)));

            formData.append('uniqueInnerTemplatePrice', JSON.parse(CryptoJS.AES.decrypt(this.actionInputuniqueInnerTemplatePrice.value, 'my-secret-key@123').toString(CryptoJS.enc.Utf8)));
            formData.append('adaptionTemplatePrice', JSON.parse(CryptoJS.AES.decrypt(this.actionInputadaptionTemplatePrice.value, 'my-secret-key@123').toString(CryptoJS.enc.Utf8)));
            formData.append('woocommercePrice', JSON.parse(CryptoJS.AES.decrypt(this.actionInputwoocommercePrice.value, 'my-secret-key@123').toString(CryptoJS.enc.Utf8)));
            formData.append('interactiveComponentPrice', JSON.parse(CryptoJS.AES.decrypt(this.actionInputinteractiveComponentPrice.value, 'my-secret-key@123').toString(CryptoJS.enc.Utf8)));
            formData.append('visualComposerPrice', JSON.parse(CryptoJS.AES.decrypt(this.actionInputvisualComposerPrice.value, 'my-secret-key@123').toString(CryptoJS.enc.Utf8)));
            axios({
                method: 'post',
                url: '<?php echo get_template_directory_uri();?>/hubspot/quote-request-hubspot.php',
                data: formData,
                headers: {'Content-Type': 'multipart/form-data'},
            }).then((response) => {
                this.setState({ successMessage : 'Thank you for contating us!' });
                this.setState({fullname: '', email: '', phone: '', website: '' ,comments:'', addlink: '', radioDemo:'', image:'', loading : false, selectedFile: null }) // <= clear form input here
                setTimeout(() => this.setState({successMessage:''}), 5000);
            }, (error) => {
                this.setState({ errorMessage : 'There was an error!' });
                this.setState({ loading : false}) // <= clear form input here
                setTimeout(() => this.setState({errorMessage: ''}), 5000);
            });
        };
        
        
        
        render() {
            const { loading, isLoading, bannerdata, selectedTechnology, selectedService, selectedFile, isRequestChecked, res, invalid, fullname, email, phone, website, comments, radioDemo, addlink} = this.state;
            var checkedVal, checkedVVal, technologyLable, homeTemplatePrice, uniqueInnerTemplatePrice, adaptionTemplatePrice, totalTemplatePrice, blogListingTemplatePrice, blogDetailTemplatePrice, interactiveComponentPrice, woocommercePrice, visualComposerPrice, addOnsPrice, seoPrice, seoPackageLable, finalTotalPrice, requestCheckedVal;
                {/*********************Request Quote Checked Start*****************************/}
                
                function getKeyValue(data) {
                    for (var prop in data)
                        return data[prop];
                }

                    if (this.state.isRequestChecked) {
                        requestCheckedVal="checked";
                    } else {
                        requestCheckedVal="";
                    }
                {/**********************Request Quote Checked End******************************/}
                {/**********************WooCommerce Calculation Start*****************************/}
                
                if (this.state.isChecked) {
                    woocommercePrice = Number(bannerdata.woocommerce_includes_cart_checkout_thank_you_default_payment_options)*Number(1);
                    checkedVal = '1'
                } else {
                    checkedVal = '0'
                    woocommercePrice = Number(bannerdata.woocommerce_includes_cart_checkout_thank_you_default_payment_options)*Number(0);
                }
                {/**********************WooCommerce Calculation End*******************************/}
                
                {/**********************Visual Composer Calculation Start*****************************/}
                if (this.state.isVChecked) {
                    checkedVVal = '1'
                    visualComposerPrice=Number(bannerdata.visual_composer_page_builder)*Number(1);
                } else {
                    checkedVVal = '0'
                    visualComposerPrice=Number(bannerdata.visual_composer_page_builder)*Number(0);
                }
                {/**********************Visual Composer Calculation End*******************************/}
                
                {/*********************Interactive Components Calculation Start****************************/}                        
                            interactiveComponentPrice = Number(bannerdata.interactive_components) * Number(this.state.componentcount);                        
                {/*********************Interactive Components Calculation End******************************/}
                
                {/**********************AddOns Total Price End*******************************/}
                    addOnsPrice = Number(woocommercePrice) + Number(visualComposerPrice) + Number(interactiveComponentPrice);
                {/**********************AddOns Total Price End*******************************/}
                
                {/*********************Technology Based Calculation Start****************************/}
                        if(selectedTechnology == "html"){
                                technologyLable="HTML";                               
                                
                                {/*********************Home Template Calculation Start****************************/}
                                    if(selectedService == "development") {
                                        homeTemplatePrice=Number(bannerdata.home_template_html) * Number(this.state.homecount);
                                    } else if(selectedService == "design_development"){
                                        homeTemplatePrice=Number(bannerdata.home_template_html_copy) * Number(this.state.homecount);
                                    }
                                    
                                {/*********************Home Template Calculation End******************************/}
                                
                                {/*********************Unique/ Inner Template Calculation Start****************************/}
                                    if(selectedService == "development") {
                                        uniqueInnerTemplatePrice=Number(bannerdata.unique_template_html) * Number(this.state.count);
                                    } else if(selectedService == "design_development"){
                                        uniqueInnerTemplatePrice=Number(bannerdata.unique_template_html_copy) * Number(this.state.count);
                                    }
                                    
                                {/*********************Unique/ Inner Template Calculation End******************************/}
                                
                                {/*********************Adaption Template Calculation Start****************************/}
                                    if(selectedService == "development") {
                                        adaptionTemplatePrice=Number(bannerdata.adaptation_template_html) * Number(this.state.adaptioncount);
                                    } else if(selectedService == "design_development"){
                                        adaptionTemplatePrice=Number(bannerdata.adaptation_template_html_copy) * Number(this.state.adaptioncount);
                                    }
                                    
                                {/*********************Adaption Template Calculation End******************************/}
                                
                        } else if(selectedTechnology == "wordpress") {
                                technologyLable="WordPress";
                                                                    
                                {/*********************Home Template Calculation Start****************************/}
                                    if(selectedService == "development") {
                                        homeTemplatePrice=Number(bannerdata.home_template_wssd) * Number(this.state.homecount);
                                    } else if(selectedService == "design_development"){
                                        homeTemplatePrice=Number(bannerdata.home_template_wssd_copy) * Number(this.state.homecount);
                                    }
                                                                    
                                {/*********************Home Template Calculation End******************************/}
                                
                                {/*********************Unique/ Inner Template Calculation Start****************************/}
                                    if(selectedService == "development") {
                                        uniqueInnerTemplatePrice=Number(bannerdata.unique_template_wssd) * Number(this.state.count);
                                    } else if(selectedService == "design_development"){
                                        uniqueInnerTemplatePrice=Number(bannerdata.unique_template_wssd_copy) * Number(this.state.count);
                                    }
                                    
                                {/*********************Unique/ Inner Template Calculation End******************************/}
                                
                                {/*********************Adaption Template Calculation Start****************************/}
                                    if(selectedService == "development") {
                                        adaptionTemplatePrice=Number(bannerdata.adaptation_template_wssd) * Number(this.state.adaptioncount);
                                    } else if(selectedService == "design_development"){
                                        adaptionTemplatePrice=Number(bannerdata.adaptation_template_wssd_copy) * Number(this.state.adaptioncount);
                                    }
                                    
                                {/*********************Adaption Template Calculation End******************************/}
                                
                        } else if(selectedTechnology == "hubspot") {                                               
                                technologyLable="HubSpot";
                                
                                {/*********************Home Template Calculation Start****************************/}
                                    if(selectedService == "development") {
                                        homeTemplatePrice=Number(bannerdata.home_template_hubspot) * Number(this.state.homecount);
                                    } else if(selectedService == "design_development"){
                                        homeTemplatePrice=Number(bannerdata.home_template_hubspot_copy) * Number(this.state.homecount);
                                    }
                                                                    
                                {/*********************Home Template Calculation End******************************/}
                                
                                {/*********************Unique/ Inner Template Calculation Start****************************/}
                                    if(selectedService == "development") {
                                        uniqueInnerTemplatePrice=Number(bannerdata.unique_template_hubspot) * Number(this.state.count);
                                    } else if(selectedService == "design_development"){
                                        uniqueInnerTemplatePrice=Number(bannerdata.unique_template_hubspot_copy) * Number(this.state.count);
                                    }
                                    
                                {/*********************Unique/ Inner Template Calculation End******************************/}
                                
                                {/*********************Adaption Template Calculation Start****************************/}
                                    if(selectedService == "development") {
                                        adaptionTemplatePrice=Number(bannerdata.adaptation_template_hubspot) * Number(this.state.adaptioncount);
                                    } else if(selectedService == "design_development"){
                                        adaptionTemplatePrice=Number(bannerdata.adaptation_template_hubspot_copy) * Number(this.state.adaptioncount);
                                    }
                                    
                                {/*********************Adaption Template Calculation End******************************/}
                                
                                {/*********************Blog Listing Template Calculation Start****************************/}
                                    if(selectedService == "development") {
                                        blogListingTemplatePrice=Number(bannerdata.blog_listing_template_hubspot) * Number(this.state.bloglistingcount);
                                    } else if(selectedService == "design_development"){
                                        blogListingTemplatePrice=Number(bannerdata.blog_listing_template_hubspot_copy) * Number(this.state.bloglistingcount);
                                    }
                                    
                                {/*********************Blog Listing Template Calculation End******************************/}
                                
                                {/*********************Blog Detail Template Calculation Start****************************/}
                                    if(selectedService == "development") {
                                        blogDetailTemplatePrice=Number(bannerdata.blog_detail_template_hubspot) * Number(this.state.blogdetailcount);
                                    } else if(selectedService == "design_development"){
                                        blogDetailTemplatePrice=Number(bannerdata.blog_detail_template_hubspot_copy) * Number(this.state.blogdetailcount);
                                    }
                                    
                                {/*********************Blog Detail Template Calculation End******************************/}
                                
                                
                        }
                        
                        {/*********************SEO Service Price Calculation Start****************************/}
                            if(this.state.selectedSeo === 'yes' && this.state.selectedPackage === 'essential'){
                                seoPrice = Number(bannerdata.essential_package);
                                seoPackageLable="Essential";
                            }else if(this.state.selectedSeo === 'yes' && this.state.selectedPackage === 'standard'){
                                seoPrice = Number(bannerdata.standard_package);
                                seoPackageLable="Standard";
                            }else if(this.state.selectedSeo === 'yes' && this.state.selectedPackage === 'advanced'){
                                seoPrice = Number(bannerdata.advanced_package);
                                seoPackageLable="Advanced";
                            }else if(this.state.selectedSeo === 'yes' && this.state.selectedPackage === 'premium'){
                                seoPrice = Number(bannerdata.premium_package);
                                seoPackageLable="Premium";
                            }else {
                                seoPrice = Number(0);
                                seoPackageLable="";
                            }       
                        {/*********************SEO Sevice Price Calculation End****************************/}
                        
                        {/*********************Total Template Price Calculation Start****************************/}
                        
                            if(selectedTechnology == "hubspot"){
                                totalTemplatePrice = Number(homeTemplatePrice) + Number(uniqueInnerTemplatePrice) + Number(adaptionTemplatePrice) + Number(blogListingTemplatePrice) + Number(blogDetailTemplatePrice);
                            } else {
                                totalTemplatePrice = Number(homeTemplatePrice) + Number(uniqueInnerTemplatePrice) + Number(adaptionTemplatePrice);
                            }
                            if(totalTemplatePrice > 0){
                                totalTemplatePrice=totalTemplatePrice;
                            } else {
                                totalTemplatePrice=0;
                            }
                                
                        {/*********************Total Template Price Calculation End****************************/}
                        
                        {/*********************Final Total Quote Price Calculation Start**************************/}    
                                                            
                            finalTotalPrice = Number(totalTemplatePrice)+Number(addOnsPrice)+Number(seoPrice);
                            if(finalTotalPrice>0){
                                finalTotalPrice=finalTotalPrice;
                            } else {
                                finalTotalPrice=0;
                            }

                            if(uniqueInnerTemplatePrice>0){
                                uniqueInnerTemplatePrice=uniqueInnerTemplatePrice;
                            } else {
                                uniqueInnerTemplatePrice="0";
                            }
                            if(adaptionTemplatePrice>0){
                                adaptionTemplatePrice=adaptionTemplatePrice;
                            } else {
                                adaptionTemplatePrice="0";
                            }
                            if(woocommercePrice > 0){
                                woocommercePrice=woocommercePrice;
                            } else {
                                woocommercePrice="0";
                            }
                            if(interactiveComponentPrice>0){
                                interactiveComponentPrice=interactiveComponentPrice;
                            } else {
                                interactiveComponentPrice="0";
                            }
                            if(visualComposerPrice>0){
                                visualComposerPrice=visualComposerPrice;
                            } else {
                                visualComposerPrice="0";
                            }
                            if(homeTemplatePrice>0){
                                homeTemplatePrice=homeTemplatePrice;
                            } else {
                                homeTemplatePrice="0";
                            }
                            if(blogListingTemplatePrice>0){
                                blogListingTemplatePrice=blogListingTemplatePrice;
                            } else {
                                blogListingTemplatePrice="0";
                            }
                            if(blogDetailTemplatePrice>0){
                                blogDetailTemplatePrice=blogDetailTemplatePrice;
                            } else {
                                blogDetailTemplatePrice="0";
                            }
                        {/*********************Final Total Quote Price Calculation End****************************/}
                {/*********************Technology Based Calculation End******************************/}
            return (                    
                   
                    <div class="email-estimator-pg animated fadeInUp" >
                    {/***************Banner Section Start**************************/}
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
                    {/***************Banner Section End**********************************/}
                    
                    {/***************Calculation Block Section Start*******************/}
                            <section className="estimat-section">
                                <div className="container">
                                    <div className="row">
                                        <div className="col-lg-7 col-md-12">
                                            <div className="estimat-content">
                                                <h3>{bannerdata.section_title}</h3>
                                                <ul className="estimat-listing">
                                                    <li>
                                                        <h4>Technology</h4>
                                                        <ul className="custom-chk-round">
                                                            <li>
                                                                <div className="custom-radio">
                                                                    <input type="radio" id="technology-1" value="html" name="radioTechnology" checked={this.state.selectedTechnology === 'html'} onChange={this.handleTechnologyChange} />
                                                                    <label for="technology-1">HTML</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div className="custom-radio">
                                                                    <input type="radio" id="technology-2" value="wordpress" name="radioTechnology" checked={this.state.selectedTechnology === 'wordpress'} onChange={this.handleTechnologyChange} />
                                                                    <label for="technology-2">WordPress</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div className="custom-radio">
                                                                    <input type="radio" id="technology-3" value="hubspot" name="radioTechnology" checked={this.state.selectedTechnology === 'hubspot'} onChange={this.handleTechnologyChange} />
                                                                    <label for="technology-3">HubSpot</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <h4>Services</h4>
                                                        <ul className="custom-chk-round">
                                                            <li>
                                                                <div className="custom-radio">
                                                                    <input type="radio" id="services-1" name="radioDemo1" value="development" checked={this.state.selectedService === 'development'} onChange={this.handleServiceChange} />
                                                                    <label for="services-1">Development</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div className="custom-radio">
                                                                    <input type="radio" id="services-2" name="radioDemo1" value="design_development" checked={this.state.selectedService === 'design_development'} onChange={this.handleServiceChange} />
                                                                    <label for="services-2">Design &amp; Development</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <h4>Templates</h4>
                                                        <ul className="number-counter-listing">
                                                            <li>

                                                                <div className="number-counter">
                                                                    <input type="text" name="UniquePage" className="qtyBox" value={this.state.homecount} min="0" max="1"/>
                                                                    <span>Home</span>
                                                                    <div className="value-button counter-plus" onClick={this.onclick.bind(this, 'addHome')} > <i className="caret-up"><img src="<?php echo get_template_directory_uri();?>/assets/images/uplers-estimators/caret-up-icon.svg" alt=""/></i> </div>
                                                                    <div className="value-button counter-minus" onClick={this.onclick.bind(this, 'subHome')} > <i className="caret-down"><img src="<?php echo get_template_directory_uri();?>/assets/images/uplers-estimators/caret-down-icon.svg" alt=""/></i> </div>
                                                                </div>   
                                                            </li>
                                                            <li>
                                                                <div className="number-counter">
                                                                    <input type="text" name="UniquePage" className="qtyBox" value={this.state.count} min="1"/>
                                                                    <span>Unique / Inner</span>
                                                                    <div className="value-button counter-plus" onClick={this.onclick.bind(this, 'add')} > <i className="caret-up"><img src="<?php echo get_template_directory_uri();?>/assets/images/uplers-estimators/caret-up-icon.svg" alt=""/></i> </div>
                                                                    <div className="value-button counter-minus" onClick={this.onclick.bind(this, 'sub')} > <i className="caret-down"><img src="<?php echo get_template_directory_uri();?>/assets/images/uplers-estimators/caret-down-icon.svg" alt=""/></i> </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div className="number-counter">
                                                                    <input type="text" name="UniquePage" className="qtyBox" value={this.state.adaptioncount} min="1"/>
                                                                    <span>Adaptations</span>
                                                                    <div className="value-button counter-plus" onClick={this.onclick.bind(this, 'addadaption')}> <i className="caret-up"><img src="<?php echo get_template_directory_uri();?>/assets/images/uplers-estimators/caret-up-icon.svg" alt=""/></i> </div>
                                                                    <div className="value-button counter-minus" onClick={this.onclick.bind(this, 'subadaption')} > <i className="caret-down"><img src="<?php echo get_template_directory_uri();?>/assets/images/uplers-estimators/caret-down-icon.svg" alt=""/></i> </div>
                                                                </div>
                                                            </li>
                                                            { //Check if unique/ inner less then 0
                                                                (selectedTechnology == "hubspot")
                                                                  ? <li>
                                                                        <div className="number-counter">
                                                                            <input type="text" name="UniquePage" className="qtyBox" value={this.state.bloglistingcount} min="1"/>
                                                                            <span>Blog Listing</span>
                                                                            <div className="value-button counter-plus" onClick={this.onclick.bind(this, 'addBloglisting')}> <i className="caret-up"><img src="<?php echo get_template_directory_uri();?>/assets/images/uplers-estimators/caret-up-icon.svg" alt=""/></i> </div>
                                                                            <div className="value-button counter-minus" onClick={this.onclick.bind(this, 'subBloglisting')} > <i className="caret-down"><img src="<?php echo get_template_directory_uri();?>/assets/images/uplers-estimators/caret-down-icon.svg" alt=""/></i> </div>
                                                                        </div>
                                                                    </li>
                                                                  : ''
                                                            }
                                                            { //Check if unique/ inner less then 0
                                                                (selectedTechnology == "hubspot")
                                                                  ? 
                                                                    <li>
                                                                        <div className="number-counter">
                                                                            <input type="text" name="UniquePage" className="qtyBox" value={this.state.blogdetailcount} min="1"/>
                                                                            <span>Blog Details</span>
                                                                            <div className="value-button counter-plus" onClick={this.onclick.bind(this, 'addBlogdetail')}> <i className="caret-up"><img src="<?php echo get_template_directory_uri();?>/assets/images/uplers-estimators/caret-up-icon.svg" alt=""/></i> </div>
                                                                            <div className="value-button counter-minus" onClick={this.onclick.bind(this, 'subBlogdetail')} > <i className="caret-down"><img src="<?php echo get_template_directory_uri();?>/assets/images/uplers-estimators/caret-down-icon.svg" alt=""/></i> </div>
                                                                        </div>
                                                                    </li>
                                                                  : ''
                                                            }
                                                            
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <h4>Add-ons</h4>
                                                        <ul className="number-counter-listing">
                                                            <li className="custom-check"> <i className="close-check" onClick={this.handleChecked}></i>
                                                                <div className="custom-chk">
                                                                    <input type="checkbox" id="add-ons-chk-1" value={checkedVal} onChange={ this.handleChecked } />
                                                                    <label for="add-ons-chk-1">WooCommerce</label>
                                                                    <span className="plus"></span> </div>
                                                            </li>
                                                            <li>
                                                                <div className="number-counter">
                                                                    <input type="text" name="UniquePage" className="qtyBox" value={this.state.componentcount} min="1"/>
                                                                    <span>Interactive Components</span>
                                                                    <div className="value-button counter-plus" onClick={this.onclick.bind(this, 'addcomponent')} > <i className="caret-up"><img src="<?php echo get_template_directory_uri();?>/assets/images/uplers-estimators/caret-up-icon.svg" alt=""/></i> </div>
                                                                    <div className="value-button counter-minus" onClick={this.onclick.bind(this, 'subcomponent')} > <i className="caret-down"><img src="<?php echo get_template_directory_uri();?>/assets/images/uplers-estimators/caret-down-icon.svg" alt=""/></i> </div>
                                                                </div>
                                                            </li>
                                                            <li className="custom-check"> <i className="close-check" onClick={this.handleVChecked}></i>
                                                                <div className="custom-chk">
                                                                    <input type="checkbox" id="add-ons-chk-2" value={checkedVVal} onChange={ this.handleVChecked } />
                                                                    <label for="add-ons-chk-2">Visual Composer</label>
                                                                    <span className="plus"></span> </div>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <h4>Interested in SEO Services?  <span className="right" title="" data-tipso={bannerdata.seo_service_package_tooltip}><i><img src="<?php echo get_template_directory_uri();?>/assets/images/uplers-estimators/info-icon.svg" alt="" /></i></span></h4>
                                                        <ul className="custom-chk-round">
                                                            <li>
                                                                <div className="custom-radio">
                                                                    <input type="radio" id="int-services-1" value="yes" name="radioSeo" checked={this.state.selectedSeo === 'yes'} onChange={this.handleSeoChange} />
                                                                    <label for="int-services-1">Yes</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div className="custom-radio">
                                                                    <input type="radio" id="int-services-2" value="no" name="radioSeo" checked={this.state.selectedSeo === 'no'} onChange={this.handleSeoChange} />
                                                                    <label for="int-services-2">No</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    { 
                                                        (this.state.selectedSeo === 'yes')?
                                                    <li>
                                                        <h6>Select a Package</h6>
                                                        <ul className="custom-chk-round">
                                                            <li>
                                                                <div className="custom-radio">
                                                                    <input type="radio" id="package-1" name="radioPackage" value="essential" checked={this.state.selectedPackage === 'essential'} onChange={this.handlePackageChange} />
                                                                    <label for="package-1">Essential</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div className="custom-radio">
                                                                    <input type="radio" id="package-2" name="radioPackage" value="standard" checked={this.state.selectedPackage === 'standard'} onChange={this.handlePackageChange}  />
                                                                    <label for="package-2">Standard</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div className="custom-radio">
                                                                    <input type="radio" id="package-3" name="radioPackage" value="advanced" checked={this.state.selectedPackage === 'advanced'} onChange={this.handlePackageChange} />
                                                                    <label for="package-3">Advanced</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div className="custom-radio">
                                                                    <input type="radio" id="package-4" name="radioPackage" value="premium" checked={this.state.selectedPackage === 'premium'} onChange={this.handlePackageChange} />
                                                                    <label for="package-4">Premium</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    : ""
                                                    }
                                                </ul>
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
                                                            (this.state.selectedTechnology)?
                                                            <tr>
                                                                <th><strong>{technologyLable}:</strong></th>
                                                                <th><strong>&nbsp;</strong></th>
                                                            </tr>
                                                            :''
                                                        }
                                                        </thead>
                                                        <tbody>
                                                            
                                                                <tr>
                                                                   {
                                                                       (this.state.selectedService === 'development')
                                                                        ? <td><strong>Development:</strong></td>
                                                                        : ""
                                                                   }
                                                                   {
                                                                       (this.state.selectedService === 'design_development')
                                                                        ? <td><strong>Design &amp; Development:</strong></td>
                                                                        : ''
                                                                   }
                                                                    
                                                                    <td><strong></strong></td>
                                                                </tr>
                                                                
                                                            <tr>
                                                                <td><strong>Templates:</strong></td>
                                                                <td><strong>$ {totalTemplatePrice}</strong></td>
                                                            </tr>
                                                            {
                                                                (homeTemplatePrice > 0)?
                                                            <tr>
                                                                <td>Home</td>
                                                                <td>$ {homeTemplatePrice}</td>
                                                            </tr>
                                                            : ''
                                                            }
                                                            { //Check if unique/ inner less then 0
                                                                (this.state.count > 0)
                                                                  ? <tr> <td>Unique/ Inner</td> <td>$ {uniqueInnerTemplatePrice}</td> </tr>
                                                                  : ''
                                                            }
                                                            { //Check if Adaption less then 0
                                                                (this.state.adaptioncount > 0)
                                                                  ? <tr> <td>Adaptations</td> <td>$ {adaptionTemplatePrice}</td> </tr>
                                                                  : ''
                                                            }
                                                            { //Check if Blog Listing less then 0
                                                                (selectedTechnology == "hubspot" && this.state.bloglistingcount > 0)
                                                                  ? <tr> <td>Blog Listing</td> <td>$ {blogListingTemplatePrice}</td> </tr>                                                                    
                                                                  : ''
                                                            }
                                                            { //Check if Blog Details less then 0
                                                                (selectedTechnology == "hubspot" && this.state.blogdetailcount > 0)
                                                                  ? <tr> <td>Blog Detail</td> <td>$ {blogDetailTemplatePrice}</td> </tr>                                                                    
                                                                  : ''
                                                            }                                                            
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            { /*****AddOn Total Price****/}
                                                            <tr> 
                                                                <td><strong>Add-Ons:</strong></td>
                                                                <td><strong>$ {addOnsPrice} </strong></td> 
                                                            </tr>  
                                                            
                                                            { //Check if WooCommerce price not equal to 0
                                                                (woocommercePrice !== 0)
                                                                  ? <tr> <td>WooCommerce</td> <td>$ {woocommercePrice}</td> </tr>                                                                    
                                                                  : ''                                                            
                                                            }
                                                            { //Check if Inreractive Component price less then 0
                                                                (this.state.componentcount > 0)
                                                                  ? <tr> <td>Interactive Components</td> <td>$ {interactiveComponentPrice}</td> </tr>                                                                    
                                                                  : ''
                                                            }
                                                            { //Check if visual composer price not equal to 0
                                                                (visualComposerPrice !== 0)
                                                                  ? <tr> <td>Visual Composer</td> <td>$ {visualComposerPrice}</td> </tr>                                                                    
                                                                  : ''                                                            
                                                            }
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            { //Check if SEO Package price not equal to 0
                                                                (seoPrice !== 0)
                                                                  ? <tr> <td><strong>SEO / Month</strong></td> <td><strong>$ {seoPrice}</strong></td> </tr>                                                                    
                                                                  : ''                                                            
                                                            }
                                                            { //Check if SEO Package price not equal to 0
                                                                (seoPrice !== 0)
                                                                  ? <tr> <td>{seoPackageLable}</td> <td>$ {seoPrice}</td> </tr>                                                                    
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
                                                                <td>${finalTotalPrice}</td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                                    
                                                        <form onSubmit={this.handleSubmit} method="post" enctype="multipart/form-data">
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
                                                                        <input type="text" value={this.state.fullname} onChange={this.onChange} name="fullname" placeholder="Full name*" required="required"/>
                                                                    </div>
                                                                </div>
                                                                <div className="col-lg-6">
                                                                    <div className="feild">
                                                                        <input type="email" name="email" value={this.state.email} onChange={this.onChange} placeholder="Email*" required="required"/>
                                                                    </div>
                                                                </div>
                                                                <div className="col-lg-6">
                                                                    <div className="feild">
                                                                        <input type="tel" name="phone" value={this.state.phone} onChange={this.onChange}  placeholder="Phone*" required="required"/>
                                                                    </div>
                                                                </div>
                                                                <div className="col-lg-6">
                                                                    <div className="feild">
                                                                        <input type="text" name="website" value={this.state.website} onChange={this.onChange} placeholder="Website*" required="required" />
                                                                    </div>
                                                                </div>
                                                                <div className="col-lg-12">
                                                                    <div className="feild">
                                                                        <textarea name="comments" value={this.state.comments} onChange={this.onChange} placeholder="Description"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div className="col-lg-12">
                                                                    <div className="feild upload-file">
                                                                        <h6>Upload</h6>

                                                                        <ul className="custom-chk-round">
                                                                            <li>
                                                                                <div className="custom-radio">
                                                                                    <input type="radio" id="upload-1" name="radioDemo" checked={this.state.radioDemo === 'Sitemap'} onChange={this.onChange} value="Sitemap" />
                                                                                    <label for="upload-1">Sitemap</label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div className="custom-radio">
                                                                                    <input type="radio" id="upload-2" name="radioDemo" checked={this.state.radioDemo === 'Wireframe'} onChange={this.onChange} value="Wireframe" />
                                                                                    <label for="upload-2">Wireframe</label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div className="custom-radio">
                                                                                    <input type="radio" id="upload-3" name="radioDemo" checked={this.state.radioDemo === 'Designs'} onChange={this.onChange} value="Designs" />
                                                                                    <label for="upload-3">Designs </label>
                                                                                </div>
                                                                            </li>
                                                                        </ul>

                                                                        <div className="fileupload">
                                                                            <label><img alt="" src="<?php echo IMG_PATH . 'uplers-estimators/upload-icon.svg'; ?>" /> </label>
                                                                            <input className="file" type="file" name="image"  tabindex="17" onChange={this.onChangeFileHandler} required="required"/>
                                                                            {/*<img src={this.state.previewselectedFile}/>*/}  
                                                                            <div className="upload">
                                                                                <input type="text" className="txtbox txtbox1" name="ipic" value={(selectedFile) ? getKeyValue(selectedFile) : ''} placeholder="Drag & Drop to upload"/>
                                                                                <label className="filename"></label> 
                                                                            </div>
                                                                            <a className="cta-button" href="javascript:;" title="Select File">Select File</a> 
                                                                        </div>
                                                                        <div className="or">Or</div>
                                                                        <div className="feild url-area">
                                                                            <input name="addlink" type="url" value={this.state.addlink} onChange={this.onChange} placeholder="Add Link" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div className="col-lg-12">
                                                                    <div className="feild submit-wrap">
                                                                        <input type="hidden" name="homeTemplatePrice" value={CryptoJS.AES.encrypt(JSON.stringify(homeTemplatePrice), 'my-secret-key@123').toString()} ref={(input) => { this.actionInputhomeTemplatePrice = input }}/>
                                                                        <input type="hidden" name="blogListingTemplatePrice" value={CryptoJS.AES.encrypt(JSON.stringify(blogListingTemplatePrice), 'my-secret-key@123').toString()} ref={(input) => { this.actionInputblogListingTemplatePrice = input }}/>
                                                                        <input type="hidden" name="blogDetailTemplatePrice" value={CryptoJS.AES.encrypt(JSON.stringify(blogDetailTemplatePrice), 'my-secret-key@123').toString()} ref={(input) => { this.actionInputblogDetailTemplatePrice = input }}/>                                                                            

                                                                        <input type="hidden" name="uniqueInnerTemplatePrice" value={CryptoJS.AES.encrypt(JSON.stringify(uniqueInnerTemplatePrice), 'my-secret-key@123').toString()} ref={(input) => { this.actionInputuniqueInnerTemplatePrice = input }}/>
                                                                        <input type="hidden" name="adaptionTemplatePrice" value={CryptoJS.AES.encrypt(JSON.stringify(adaptionTemplatePrice), 'my-secret-key@123').toString()} ref={(input) => { this.actionInputadaptionTemplatePrice = input }}/>        
                                                                        <input type="hidden" name="woocommercePrice" value={CryptoJS.AES.encrypt(JSON.stringify(woocommercePrice), 'my-secret-key@123').toString()} ref={(input) => { this.actionInputwoocommercePrice = input }}/>        
                                                                        <input type="hidden" name="interactiveComponentPrice" value={CryptoJS.AES.encrypt(JSON.stringify(interactiveComponentPrice), 'my-secret-key@123').toString()} ref={(input) => { this.actionInputinteractiveComponentPrice = input }}/>        
                                                                        <input type="hidden" name="visualComposerPrice" value={CryptoJS.AES.encrypt(JSON.stringify(visualComposerPrice), 'my-secret-key@123').toString()} ref={(input) => { this.actionInputvisualComposerPrice = input }}/>        
                                                                        <input type="submit" name="submit" value="submit"/>
                                                                        {
                                                                            (this.state.loading)?
                                                                            <span className="spinner"></span>
                                                                            : ""
                                                                        }
                                                                    </div>
                                                                </div>
                                                                { (this.state.successMessage)?
                                                                    <span className="suceessmsg"> { this.state.successMessage } </span>
                                                                    : <span className="errormsg"> { this.state.errorMessage }</span>
                                                                   
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
                            {/***************Calculation Block Section End*******************/}
                                    
                            {/***************Bottom Block Section Start**************************/}
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
                    {/***************Bottom Block Section End**************************/}        
                    </div>
                    
                    
                     
            );
        }
    }

ReactDOM.render(<QuoteForm />, document.getElementById('main'));

</script>
<?php get_footer(); ?>