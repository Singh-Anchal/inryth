export default {
    "name": "Inryth Assistant",
    "welcome": "Hi! I'm your digital growth assistant. What would you like help with today?",
    "offline": "I can help you explore options here, or you can continue with the team on WhatsApp.",
    "quick_replies": [
        {
            "id": "services",
            "label": "Explore Services"
        },
        {
            "id": "products",
            "label": "View Products"
        },
        {
            "id": "website",
            "label": "Get Website Quote"
        },
        {
            "id": "ads",
            "label": "Run Ads"
        },
        {
            "id": "whatsapp",
            "label": "WhatsApp Automation"
        },
        {
            "id": "expert",
            "label": "Talk to Expert"
        }
    ],
    "nodes": {
        "services": {
            "message": "Which area are you looking at?",
            "buttons": [
                {
                    "id": "website",
                    "label": "Website"
                },
                {
                    "id": "digital-marketing",
                    "label": "Digital Marketing"
                },
                {
                    "id": "google-ads",
                    "label": "Google Ads"
                },
                {
                    "id": "meta-ads",
                    "label": "Meta Ads"
                },
                {
                    "id": "seo",
                    "label": "SEO"
                },
                {
                    "id": "whatsapp",
                    "label": "WhatsApp Automation"
                },
                {
                    "id": "products",
                    "label": "Products"
                },
                {
                    "id": "expert",
                    "label": "Talk to Expert"
                }
            ]
        },
        "website": {
            "message": "What do you need for the website?",
            "buttons": [
                {
                    "id": "website-new",
                    "label": "New Website"
                },
                {
                    "id": "website-redesign",
                    "label": "Redesign"
                },
                {
                    "id": "website-landing",
                    "label": "Landing Page"
                },
                {
                    "id": "website-ecom",
                    "label": "E-commerce"
                }
            ]
        },
        "website-new": {
            "message": "A new business website is a strong starting point. We can scope pages, enquiry paths and WhatsApp in one project.",
            "cta": true,
            "link": "/services/website-design",
            "link_label": "See website services"
        },
        "website-redesign": {
            "message": "Redesigns work best when we first identify why the current site is not generating enquiries.",
            "cta": true,
            "link": "/contact?service=website-design&form=website",
            "link_label": "Request a website review"
        },
        "website-landing": {
            "message": "Landing pages should match one ad or offer. We can build that as a page or as the Conversion Landing System.",
            "cta": true,
            "link": "/services/website-design",
            "link_label": "See landing pages"
        },
        "website-ecom": {
            "message": "Shopify or custom ecommerce with WhatsApp for catalogues, orders and recovery. Dedicated store bots are coming soon.",
            "cta": true,
            "link": "/contact?service=website-design&form=website",
            "link_label": "Get an e-commerce quote"
        },
        "digital-marketing": {
            "message": "Digital marketing at Inryth means a system: traffic, converting pages and follow-up. Which channel is the priority?",
            "buttons": [
                {
                    "id": "google-ads",
                    "label": "Google Ads"
                },
                {
                    "id": "meta-ads",
                    "label": "Meta Ads"
                },
                {
                    "id": "seo",
                    "label": "SEO"
                },
                {
                    "id": "expert",
                    "label": "Talk to Expert"
                }
            ]
        },
        "google-ads": {
            "message": "We manage Search, Display, Performance Max and remarketing with landing pages and conversion tracking.",
            "cta": true,
            "link": "/services/google-ads",
            "link_label": "See Google Ads"
        },
        "meta-ads": {
            "message": "Meta Ads work when creative, offer and follow-up are planned together. We can map Facebook and Instagram campaigns to WhatsApp or your CRM.",
            "cta": true,
            "link": "/services/meta-ads",
            "link_label": "See Meta Ads"
        },
        "seo": {
            "message": "SEO starts with an audit: technical health, service pages and local visibility. We can review your current site first.",
            "cta": true,
            "link": "/services/seo",
            "link_label": "See SEO services"
        },
        "ads": {
            "message": "Are you looking at search ads, social ads, or both?",
            "buttons": [
                {
                    "id": "google-ads",
                    "label": "Google Ads"
                },
                {
                    "id": "meta-ads",
                    "label": "Meta Ads"
                },
                {
                    "id": "digital-marketing",
                    "label": "Full marketing plan"
                }
            ]
        },
        "whatsapp": {
            "message": "WhatsApp automation can welcome leads, qualify them, send brochures and route chats to your team.",
            "cta": true,
            "link": "/services/whatsapp-automation",
            "link_label": "See WhatsApp automation"
        },
        "products": {
            "message": "Industry WhatsApp bots are coming soon. Until they ship, we still build websites, ads, graphics and WhatsApp flows.",
            "buttons": [
                {
                    "id": "product-ecom",
                    "label": "Ecommerce Bot"
                },
                {
                    "id": "product-wp",
                    "label": "WordPress Lead Bot"
                },
                {
                    "id": "product-health",
                    "label": "Healthcare Bot"
                },
                {
                    "id": "product-re",
                    "label": "Real Estate Bot"
                }
            ]
        },
        "product-ecom": {
            "message": "The Ecommerce WhatsApp Bot is coming soon. We can still build your Shopify or custom store and connect WhatsApp today.",
            "cta": true,
            "link": "/products/ecommerce-whatsapp-bot",
            "link_label": "Join waitlist"
        },
        "product-wp": {
            "message": "The WordPress Lead Bot is coming soon. We can still connect WP-Forms and CF7 to WhatsApp on a live site now.",
            "cta": true,
            "link": "/products/wordpress-lead-bot",
            "link_label": "Join waitlist"
        },
        "product-health": {
            "message": "The Healthcare WhatsApp Bot is coming soon. Clinic websites, graphics and WhatsApp booking paths are available now.",
            "cta": true,
            "link": "/products/healthcare-bot",
            "link_label": "Join waitlist"
        },
        "product-re": {
            "message": "The Real Estate WhatsApp Bot is coming soon. Project websites, ads creatives and enquiry WhatsApp flows are open now.",
            "cta": true,
            "link": "/products/real-estate-bot",
            "link_label": "Join waitlist"
        },
        "pricing": {
            "message": "We do not publish one-size prices because scope changes by pages, ads workload and integrations. Share a few details and we will propose honestly.",
            "cta": true,
            "link": "/contact",
            "link_label": "Request a proposal"
        },
        "expert": {
            "message": "Would you like a quick consultation?",
            "buttons": [
                {
                    "id": "consult-yes",
                    "label": "Yes"
                },
                {
                    "id": "consult-wa",
                    "label": "WhatsApp"
                },
                {
                    "id": "consult-later",
                    "label": "Later"
                }
            ]
        },
        "consult-yes": {
            "message": "Share a few details on the consultation form. We will review and get back during business hours.",
            "cta": true,
            "link": "/contact?form=marketing",
            "link_label": "Book consultation"
        },
        "consult-wa": {
            "message": "Continue on WhatsApp and tell us what you sell and what you need help with first.",
            "whatsapp": true,
            "whatsapp_label": "Chat on WhatsApp"
        },
        "consult-later": {
            "message": "No problem. You can browse services or products and come back when you are ready.",
            "buttons": [
                {
                    "id": "services",
                    "label": "Explore Services"
                },
                {
                    "id": "products",
                    "label": "View Products"
                }
            ]
        }
    }
};
