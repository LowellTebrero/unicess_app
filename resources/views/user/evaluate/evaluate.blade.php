<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            font-size: 62.5%;
        }

        .height1 {
            page-break-after: always;
            position: relative;
        }
        .height2 {
            min-height: 100vh;
            position: relative;
        }

        .img {
            position: absolute;
            left: 5%;
            width: 87%;
            z-index: 1;

        }

        .img2 {
            position: absolute;
            left: 5%;
            width: 87%;

        }
        .lowell {
            position: absolute;
            top: 40%;
            left: 30%;
            z-index: 2;
        }
        .faculty_id {
            position: absolute;
            top: 13.2%;
            left: 26.5%;
            z-index: 2;
            font-size: .7rem;
        }
        .period_of_evaluation {
            position: absolute;
            top: 13%;
            right: 31.2%;
            z-index: 2;
            font-size: 1rem;
        }
        .chairmanship_university {
            position: absolute;
            top: 38.6%;
            right: 28%;
            z-index: 2;
            font-size: 1rem;
        }

        .chairmanship_college {
            position: absolute;
            top: 40%;
            right: 30.5%;
            z-index: 2;
            font-size: 1rem;
        }
        .membership_university {
            position: absolute;
            top: 42.5%;
            right: 28%;
            z-index: 2;
            font-size: 1rem;
        }

        .membership_college {
            position: absolute;
            top: 44%;
            right: 30.5%;
            z-index: 2;
            font-size: 1rem;
        }

        .advisorship {
            position: absolute;
            top: 46.7%;
            right: 30.5%;
            z-index: 2;
            font-size: 1rem;
        }

        .oic {
            position: absolute;
            top: 49%;
            right: 30.5%;
            z-index: 2;
            font-size: 1rem;
        }
        .judge {
            position: absolute;
            top: 54.8%;
            right: 27.5%;
            z-index: 2;
            font-size: 1rem;
        }

        .resource {
            position: absolute;
            bottom: 33.5%;
            right: 32.5%;
            z-index: 2;
            font-size: 1rem;
        }
        .chairmanship_membership {
            position: absolute;
            bottom: 26.7%;
            right: 32.5%;
            z-index: 2;
            font-size: 1rem;
        }

        .facilication_on_going {
            position: absolute;
            bottom: 23.9%;
            right: 32.5%;
            z-index: 2;
            font-size: 1rem;
        }
        .facilication_regional {
            position: absolute;
            bottom: 22.5%;
            right: 32.5%;
            z-index: 2;
            font-size: 1rem;
        }
        .facilication_national {
            position: absolute;
            bottom: 21.2%;
            right: 32.5%;
            z-index: 2;
            font-size: 1rem;
        }

        .facilication_international {
            position: absolute;
            bottom: 19.9%;
            right: 28.3%;
            z-index: 2;
            font-size: 1rem;
        }

        .training_director_local {
            position: absolute;
            top: 20%;
            right: 40.5%;
            z-index: 2;
            font-size: 1rem;
        }
        .training_director_international {
            position: absolute;
            top: 21.3%;
            right: 37.3%;
            z-index: 2;
            font-size: 1rem;
        }
        .resource_speaker_local {
            position: absolute;
            top: 24%;
            right: 37.4%;
            z-index: 2;
            font-size: 1rem;
        }
        .resource_speaker_international {
            position: absolute;
            top: 25.3%;
            right: 37.4%;
            z-index: 2;
            font-size: 1rem;
        }

        .facilitator_moderator_local {
            position: absolute;
            top: 28%;
            right: 37.4%;
            z-index: 2;
            font-size: 1rem;
        }

        .facilitator_moderator_international {
            position: absolute;
            top: 29.3%;
            right: 37.4%;
            z-index: 2;
            font-size: 1rem;
        }
        .reactor_panel_member_local {
            position: absolute;
            top: 32%;
            right: 37.4%;
            z-index: 2;
            font-size: 1rem;
        }
        .reactor_panel_member_international {
            position: absolute;
            top: 33.4%;
            right: 37.4%;
            z-index: 2;
            font-size: 1rem;
        }

        .technical_assistance {
            position: absolute;
            top: 36%;
            right: 40.5%;
            z-index: 2;
            font-size: 1rem;
        }
        .judge_community {
            position: absolute;
            top: 40%;
            right: 37.5%;
            z-index: 2;
            font-size: 1rem;
        }

        .commencement_guest_speaker {
            position: absolute;
            top: 41.5%;
            right: 40.5%;
            z-index: 2;
            font-size: 1rem;
        }

        .coordinator_organizer_consultants {
            position: absolute;
            top: 49.5%;
            right: 34%;
            z-index: 2;
            font-size: 1rem;
        }

        .resource_person_lecturer {
            position: absolute;
            top: 51%;
            right: 34%;
            z-index: 2;
            font-size: 1rem;
        }
        .facilitator {
            position: absolute;
            top: 52.3%;
            right: 31%;
            z-index: 2;
            font-size: 1rem;
        }
        .member {
            position: absolute;
            top: 53.7%;
            right: 31%;
            z-index: 2;
            font-size: 1rem;
        }
        .total_points {
            position: absolute;
            top: 56.4%;
            right: 30%;
            z-index: 2;
            font-size: 1rem;
        }


    </style>
</head>
<body>
    <section class="height1">

        <h1 class="faculty_id">{{ $evaluations->faculty_id }} </h1>
        <h1 class="period_of_evaluation">{{ $evaluations->period_of_evaluation }} </h1>
        <h1 class="chairmanship_university">{{ $evaluations->chairmanship_university }}</h1>
        <h1 class="chairmanship_college">{{ $evaluations->chairmanship_college }}</h1>
        <h1 class="membership_university">{{ $evaluations->membership_university }}</h1>
        <h1 class="membership_college">{{ $evaluations->membership_college }}</h1>
        <h1 class="advisorship">{{ $evaluations->advisorship }}</h1>
        <h1 class="oic">{{ $evaluations->oic }}</h1>
        <h1 class="judge">{{ $evaluations->judge }}</h1>
        <h1 class="resource">{{ $evaluations->resource }}</h1>
        <h1 class="chairmanship_membership">{{ $evaluations->chairmanship_membership }}</h1>
        <h1 class="facilication_on_going">{{ $evaluations->facilication_on_going }}</h1>
        <h1 class="facilication_regional">{{ $evaluations->facilication_regional }}</h1>
        <h1 class="facilication_national">{{ $evaluations->facilication_national }}</h1>
        <h1 class="facilication_international">{{ $evaluations->facilication_international }}</h1>

        <img src="{{ public_path("/img/evalute-1.jpg") }}" alt=""  class="img">

    </section>

    <section class="height2">
        <h1 class="training_director_local">{{ $evaluations->training_director_local }}</h1>
        <h1 class="training_director_international">{{ $evaluations->training_director_international }}</h1>
        <h1 class="resource_speaker_local">{{ $evaluations->resource_speaker_local }}</h1>
        <h1 class="resource_speaker_international">{{ $evaluations->resource_speaker_international }}</h1>
        <h1 class="facilitator_moderator_local">{{ $evaluations->facilitator_moderator_local }}</h1>
        <h1 class="facilitator_moderator_international">{{ $evaluations->facilitator_moderator_international }}</h1>
        <h1 class="reactor_panel_member_local">{{ $evaluations->reactor_panel_member_local }}</h1>
        <h1 class="reactor_panel_member_international">{{ $evaluations->reactor_panel_member_international }}</h1>
        <h1 class="technical_assistance">{{ $evaluations->technical_assistance }}</h1>
        <h1 class="judge_community">{{ $evaluations->judge_community }}</h1>
        <h1 class="commencement_guest_speaker">{{ $evaluations->commencement_guest_speaker }}</h1>
        <h1 class="coordinator_organizer_consultants">{{ $evaluations->coordinator_organizer_consultants }}</h1>
        <h1 class="resource_person_lecturer">{{ $evaluations->resource_person_lecturer }}</h1>
        <h1 class="facilitator">{{ $evaluations->facilitator }}</h1>
        <h1 class="member">{{ $evaluations->member }}</h1>
        <h1 class="total_points">{{ $evaluations->total_points }}</h1>
        <img src="{{ public_path("/img/evalute-2.jpg") }}" alt=""  class="img2">
    </section>

</body>
</html>
