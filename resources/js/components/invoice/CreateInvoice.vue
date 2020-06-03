<template>
    <div>

    </div>
</template>

<script>
export default {
    data(){
        return {
            customer: {
                id: 1,
                name: "Baupartner",
                address: "Bla",
                phone: "phone",
                scan_doc: null,
                blacklist: 0,
                comments: null,
            },
            tools: [
                {
                    id: 1,
                    brand: "Makita",
                    model: "HM1203",
                    description: "Stemarica",
                    serial_number: null,
                    price_for_4h: 1500,
                    price_for_24h: 2200,
                    onStock: 1,
                    tool_picture_url: null,
                    comments: null,
                }
            ],

        }
    }
}
</script>