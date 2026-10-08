<?php
if (!defined('INRYTH')) {
    http_response_code(403);
    exit;
}

return [
    'general' => [
        ['q' => 'What does Inryth actually do?', 'a' => 'We help Indian businesses build a digital growth system: a website that can convert, campaigns that bring qualified traffic, and automation that follows up on WhatsApp and in your lead process.'],
        ['q' => 'Do you work only with large companies?', 'a' => 'No. Most of our work is with SMEs, startups, local businesses and professional service firms that need a practical system, not an enterprise stack.'],
        ['q' => 'Can I start with one service?', 'a' => 'Yes. Many clients start with a website, a landing page, SEO or WhatsApp automation. We still design that piece so it can connect to the rest later.'],
        ['q' => 'Do you show fixed prices on the website?', 'a' => 'Not as a default. Scope changes with pages, integrations and campaign workload. We share a custom proposal after understanding the requirement.'],
        ['q' => 'How do we start?', 'a' => 'Share your requirement through the form or WhatsApp. We review it, ask a few clarifying questions, and recommend a next step — not a generic package.'],
    ],
    'digital-marketing' => [
        ['q' => 'Is digital marketing only social media?', 'a' => 'No. Social can be part of it. We focus on channels that can create measurable enquiries: search, ads, landing pages, SEO and follow-up.'],
        ['q' => 'How soon will I see leads?', 'a' => 'Paid campaigns can generate enquiries quickly if the offer and page are ready. SEO takes longer. We will tell you which timeline applies before you spend.'],
        ['q' => 'Do you need access to my ad accounts?', 'a' => 'Yes, with you as the owner. You should always retain account ownership.'],
    ],
    'google-ads' => [
        ['q' => 'What Google Ads types do you manage?', 'a' => 'Search, Display, Performance Max, remarketing and lead-generation setups, depending on the offer and tracking readiness.'],
        ['q' => 'Do I need a landing page?', 'a' => 'If you are spending consistently, yes. A focused page usually converts better than a homepage and is easier to measure.'],
        ['q' => 'Who pays the ad media cost?', 'a' => 'You pay Google directly from your billing profile. Our fee is for strategy, setup and optimisation.'],
        ['q' => 'Can you work with an existing account?', 'a' => 'Yes. We start with an audit of structure, queries, landing pages and conversion tracking.'],
    ],
    'meta-ads' => [
        ['q' => 'Do you run both Facebook and Instagram ads?', 'a' => 'Yes. They are managed in Meta Ads Manager as one system, with creatives suited to each placement.'],
        ['q' => 'Why do my current leads feel low quality?', 'a' => 'Often the offer is too broad, the form is too easy, or follow-up is slow. We fix creative, audience and the conversation after the lead arrives.'],
        ['q' => 'Do you design the creatives?', 'a' => 'We can. Creative is part of performance, so we prefer not to separate it from the campaign plan.'],
    ],
    'seo' => [
        ['q' => 'How long does SEO take?', 'a' => 'It depends on competition, current technical health and content. We set expectations after an audit rather than promising a ranking date.'],
        ['q' => 'Do you guarantee first-page rankings?', 'a' => 'No. Nobody honest can guarantee rankings. We can guarantee clear work: technical fixes, better pages, and measurement.'],
        ['q' => 'Is local SEO included?', 'a' => 'For businesses that serve a city or region, local SEO is part of the plan. We do not create thin city pages just to add URLs.'],
    ],
    'website' => [
        ['q' => 'Do you build WordPress and custom PHP sites?', 'a' => 'Yes. We choose the stack based on the project. This website itself is a maintainable PHP architecture.'],
        ['q' => 'Will my site be mobile-friendly?', 'a' => 'Mobile-first is the default. Layouts are designed for phones first, then tablets and desktops.'],
        ['q' => 'Do you also write the content?', 'a' => 'We structure and write conversion-focused copy from your business facts. You approve before launch.'],
        ['q' => 'Can you redesign my existing website?', 'a' => 'Yes. Redesigns usually start with what is failing: clarity, speed, mobile use or lead capture.'],
    ],
    'whatsapp' => [
        ['q' => 'Is this the WhatsApp Business app or the API?', 'a' => 'We recommend based on volume and features. Smaller teams can start with structured Business workflows. Higher volume usually needs the official API.'],
        ['q' => 'Will messages feel robotic?', 'a' => 'They should not. We keep flows short and hand over to a person once the lead is qualified.'],
        ['q' => 'Can you connect WhatsApp to Google Sheets or a CRM?', 'a' => 'Yes. Sheets are a common first step. CRM and n8n come next when the process is stable.'],
    ],
    'leads' => [
        ['q' => 'Do I need a heavy CRM?', 'a' => 'Not always. Many teams need a simple pipeline, owners and reminders. We only add complexity when it helps daily use.'],
        ['q' => 'Can leads from ads and the website sit together?', 'a' => 'That is the point. One intake, source tags, and a next action for each enquiry.'],
    ],
    'automation' => [
        ['q' => 'What tools do you use for automation?', 'a' => 'It depends on the job: website chatbot, WhatsApp flows, n8n, APIs, sheets and CRMs. We do not lock you to one vendor without a reason.'],
        ['q' => 'Can the chatbot be connected to AI later?', 'a' => 'Yes. The chatbot on this site is built with a separate UI, logic and API layer so an AI backend can be added later.'],
    ],
    'creative' => [
        ['q' => 'Do you only design social posts?', 'a' => 'No. We design for the funnel: ads, landing visuals, social and brand consistency.'],
        ['q' => 'Can you match our existing brand?', 'a' => 'Yes. If you have brand rules, we follow them. If you do not, we create a simple system first.'],
    ],
    'pricing' => [
        ['q' => 'Why is pricing not listed?', 'a' => 'A website, an ads retainer and a WhatsApp API setup are different projects. Fixed public prices often become misleading. We propose after scope is clear.'],
        ['q' => 'Do you offer packages?', 'a' => 'We have starting shapes — Starter, Growth, Performance, Automation and Custom — but the proposal is still tailored.'],
    ],
    'process' => [
        ['q' => 'What does the first week look like?', 'a' => 'We collect access, clarify the offer, and agree the first deliverable. You will know what is in progress and what is waiting on you.'],
        ['q' => 'Who will we talk to?', 'a' => 'You work with a small team, not a ticket void. WhatsApp remains available for quick coordination.'],
    ],
    'support' => [
        ['q' => 'Do you support the website after launch?', 'a' => 'Yes. We can keep a care plan for updates, measurement and small improvements.'],
        ['q' => 'What are your working hours?', 'a' => 'Monday to Saturday, 10:00 AM to 7:00 PM IST. Urgent WhatsApp messages are reviewed in business hours unless a campaign is actively launching.'],
    ],
];
