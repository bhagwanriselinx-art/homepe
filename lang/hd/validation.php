<?php

return [

    /*
    |--------------------------------------------------------------------------
    | मान्यता (Validation) भाषा लाइन्स
    |--------------------------------------------------------------------------
    |
    | नीचे दिए गए संदेश डिफ़ॉल्ट त्रुटि संदेश हैं जो वैलिडेटर क्लास
    | द्वारा उपयोग किए जाते हैं। कुछ नियमों के कई संस्करण हो सकते हैं
    | जैसे कि आकार (size) नियम। आप इन्हें यहाँ अपनी आवश्यकता अनुसार बदल सकते हैं।
    |
    */

    'accepted' => ':attribute स्वीकार किया जाना चाहिए।',
    'accepted_if' => ':attribute स्वीकार किया जाना चाहिए जब :other :value हो।',
    'active_url' => ':attribute एक मान्य URL नहीं है।',
    'after' => ':attribute :date के बाद की तारीख होनी चाहिए।',
    'after_or_equal' => ':attribute :date के बाद या उसके बराबर की तारीख होनी चाहिए।',
    'alpha' => ':attribute केवल अक्षरों से बना होना चाहिए।',
    'alpha_dash' => ':attribute केवल अक्षरों, संख्याओं, डैश और अंडरस्कोर से बना होना चाहिए।',
    'alpha_num' => ':attribute केवल अक्षरों और संख्याओं से बना होना चाहिए।',
    'array' => ':attribute एक एरे (array) होना चाहिए।',
    'ascii' => ':attribute केवल सिंगल-बाइट अल्फ़ान्यूमेरिक वर्ण और प्रतीक होना चाहिए।',
    'before' => ':attribute :date से पहले की तारीख होनी चाहिए।',
    'before_or_equal' => ':attribute :date से पहले या उसके बराबर की तारीख होनी चाहिए।',
    'between' => [
        'array' => ':attribute में :min से :max आइटम होने चाहिए।',
        'file' => ':attribute :min से :max किलोबाइट के बीच होना चाहिए।',
        'numeric' => ':attribute :min से :max के बीच होना चाहिए।',
        'string' => ':attribute :min से :max अक्षरों के बीच होना चाहिए।',
    ],
    'boolean' => ':attribute फ़ील्ड true या false होना चाहिए।',
    'confirmed' => ':attribute पुष्टि मेल नहीं खाती।',
    'current_password' => 'पासवर्ड गलत है।',
    'date' => ':attribute मान्य तारीख नहीं है।',
    'date_equals' => ':attribute :date के बराबर की तारीख होनी चाहिए।',
    'date_format' => ':attribute प्रारूप :format से मेल नहीं खाता।',
    'decimal' => ':attribute में :decimal दशमलव स्थान होने चाहिए।',
    'declined' => ':attribute अस्वीकार किया जाना चाहिए।',
    'declined_if' => ':attribute अस्वीकार किया जाना चाहिए जब :other :value हो।',
    'different' => ':attribute और :other अलग होने चाहिए।',
    'digits' => ':attribute :digits अंकों का होना चाहिए।',
    'digits_between' => ':attribute :min से :max अंकों के बीच होना चाहिए।',
    'dimensions' => ':attribute की इमेज का आयाम अमान्य है।',
    'distinct' => ':attribute फ़ील्ड में डुप्लिकेट मान है।',
    'doesnt_end_with' => ':attribute निम्नलिखित में से किसी एक के साथ समाप्त नहीं होना चाहिए: :values।',
    'doesnt_start_with' => ':attribute निम्नलिखित में से किसी एक के साथ शुरू नहीं होना चाहिए: :values।',
    'email' => ':attribute एक मान्य ईमेल पता होना चाहिए।',
    'ends_with' => ':attribute निम्नलिखित में से किसी एक पर समाप्त होना चाहिए: :values।',
    'enum' => 'चयनित :attribute अमान्य है।',
    'exists' => 'चयनित :attribute अमान्य है।',
    'file' => ':attribute एक फ़ाइल होना चाहिए।',
    'filled' => ':attribute फ़ील्ड में मान होना चाहिए।',
    'gt' => [
        'array' => ':attribute में :value से अधिक आइटम होने चाहिए।',
        'file' => ':attribute :value किलोबाइट से अधिक होना चाहिए।',
        'numeric' => ':attribute :value से अधिक होना चाहिए।',
        'string' => ':attribute :value अक्षरों से अधिक होना चाहिए।',
    ],
    'gte' => [
        'array' => ':attribute में :value आइटम या उससे अधिक होने चाहिए।',
        'file' => ':attribute :value किलोबाइट से अधिक या उसके बराबर होना चाहिए।',
        'numeric' => ':attribute :value से अधिक या बराबर होना चाहिए।',
        'string' => ':attribute :value अक्षरों से अधिक या बराबर होना चाहिए।',
    ],
    'image' => ':attribute एक इमेज होना चाहिए।',
    'in' => 'चयनित :attribute अमान्य है।',
    'in_array' => ':attribute फ़ील्ड :other में मौजूद नहीं है।',
    'integer' => ':attribute एक पूर्णांक (integer) होना चाहिए।',
    'ip' => ':attribute एक मान्य IP पता होना चाहिए।',
    'ipv4' => ':attribute एक मान्य IPv4 पता होना चाहिए।',
    'ipv6' => ':attribute एक मान्य IPv6 पता होना चाहिए।',
    'json' => ':attribute एक मान्य JSON स्ट्रिंग होना चाहिए।',
    'lowercase' => ':attribute लोअरकेस (small letters) में होना चाहिए।',
    'lt' => [
        'array' => ':attribute में :value से कम आइटम होने चाहिए।',
        'file' => ':attribute :value किलोबाइट से कम होना चाहिए।',
        'numeric' => ':attribute :value से कम होना चाहिए।',
        'string' => ':attribute :value अक्षरों से कम होना चाहिए।',
    ],
    'lte' => [
        'array' => ':attribute में :value से अधिक आइटम नहीं होने चाहिए।',
        'file' => ':attribute :value किलोबाइट से कम या बराबर होना चाहिए।',
        'numeric' => ':attribute :value से कम या बराबर होना चाहिए।',
        'string' => ':attribute :value अक्षरों से कम या बराबर होना चाहिए।',
    ],
    'mac_address' => ':attribute एक मान्य MAC पता होना चाहिए।',
    'max' => [
        'array' => ':attribute में :max से अधिक आइटम नहीं हो सकते।',
        'file' => ':attribute :max किलोबाइट से अधिक नहीं हो सकता।',
        'numeric' => ':attribute :max से अधिक नहीं हो सकता।',
        'string' => ':attribute :max अक्षरों से अधिक नहीं हो सकता।',
    ],
    'max_digits' => ':attribute में :max अंकों से अधिक नहीं होने चाहिए।',
    'mimes' => ':attribute प्रकार की फ़ाइल होनी चाहिए: :values।',
    'mimetypes' => ':attribute प्रकार की फ़ाइल होनी चाहिए: :values।',
    'min' => [
        'array' => ':attribute में कम से कम :min आइटम होने चाहिए।',
        'file' => ':attribute कम से कम :min किलोबाइट का होना चाहिए।',
        'numeric' => ':attribute कम से कम :min होना चाहिए।',
        'string' => ':attribute कम से कम :min अक्षरों का होना चाहिए।',
    ],
    'min_digits' => ':attribute में कम से कम :min अंक होने चाहिए।',
    'multiple_of' => ':attribute :value का गुणज होना चाहिए।',
    'not_in' => 'चयनित :attribute अमान्य है।',
    'not_regex' => ':attribute का फॉर्मेट अमान्य है।',
    'numeric' => ':attribute एक संख्या होनी चाहिए।',
    'password' => [
        'letters' => ':attribute में कम से कम एक अक्षर होना चाहिए।',
        'mixed' => ':attribute में कम से कम एक बड़ा और एक छोटा अक्षर होना चाहिए।',
        'numbers' => ':attribute में कम से कम एक संख्या होना चाहिए।',
        'symbols' => ':attribute में कम से कम एक प्रतीक होना चाहिए।',
        'uncompromised' => 'दिया गया :attribute डेटा लीक में पाया गया है। कृपया अलग :attribute चुनें।',
    ],
    'present' => ':attribute फ़ील्ड मौजूद होना चाहिए।',
    'prohibited' => ':attribute फ़ील्ड निषिद्ध है।',
    'prohibited_if' => ':attribute फ़ील्ड निषिद्ध है जब :other :value हो।',
    'prohibited_unless' => ':attribute फ़ील्ड निषिद्ध है जब तक कि :other :values में न हो।',
    'prohibits' => ':attribute फ़ील्ड :other को मौजूद होने से रोकता है।',
    'regex' => ':attribute का फॉर्मेट अमान्य है।',
    'required' => ':attribute फ़ील्ड आवश्यक है।',
    'required_array_keys' => ':attribute फ़ील्ड में निम्नलिखित प्रविष्टियाँ होनी चाहिए: :values।',
    'required_if' => ':attribute फ़ील्ड आवश्यक है जब :other :value हो।',
    'required_if_accepted' => ':attribute फ़ील्ड आवश्यक है जब :other स्वीकार किया गया हो।',
    'required_unless' => ':attribute फ़ील्ड आवश्यक है जब तक कि :other :values में न हो।',
    'required_with' => ':attribute फ़ील्ड आवश्यक है जब :values मौजूद हो।',
    'required_with_all' => ':attribute फ़ील्ड आवश्यक है जब :values मौजूद हों।',
    'required_without' => ':attribute फ़ील्ड आवश्यक है जब :values मौजूद न हों।',
    'required_without_all' => ':attribute फ़ील्ड आवश्यक है जब :values में से कोई मौजूद न हो।',
    'same' => ':attribute और :other मेल खाने चाहिए।',
    'size' => [
        'array' => ':attribute में :size आइटम होने चाहिए।',
        'file' => ':attribute :size किलोबाइट का होना चाहिए।',
        'numeric' => ':attribute :size होना चाहिए।',
        'string' => ':attribute :size अक्षरों का होना चाहिए।',
    ],
    'starts_with' => ':attribute निम्नलिखित में से किसी एक के साथ शुरू होना चाहिए: :values।',
    'string' => ':attribute एक स्ट्रिंग होनी चाहिए।',
    'timezone' => ':attribute एक मान्य टाइमज़ोन होना चाहिए।',
    'unique' => ':attribute पहले ही लिया जा चुका है।',
    'uploaded' => ':attribute अपलोड करने में विफल रहा।',
    'uppercase' => ':attribute अपरकेस (capital letters) में होना चाहिए।',
    'url' => ':attribute एक मान्य URL होना चाहिए।',
    'ulid' => ':attribute एक मान्य ULID होना चाहिए।',
    'uuid' => ':attribute एक मान्य UUID होना चाहिए।',

    /*
    |--------------------------------------------------------------------------
    | कस्टम मान्यता संदेश (Custom Validation Language Lines)
    |--------------------------------------------------------------------------
    |
    | आप यहाँ attribute.rule का उपयोग करके किसी विशेष फ़ील्ड के लिए
    | कस्टम संदेश निर्दिष्ट कर सकते हैं।
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | कस्टम वैलिडेशन एट्रिब्यूट्स (Custom Validation Attributes)
    |--------------------------------------------------------------------------
    |
    | यहाँ आप एट्रिब्यूट प्लेसहोल्डर को अधिक पठनीय नामों से बदल सकते हैं,
    | जैसे कि "E-Mail Address" की बजाय "ईमेल पता"।
    |
    */

    'attributes' => [],

];
