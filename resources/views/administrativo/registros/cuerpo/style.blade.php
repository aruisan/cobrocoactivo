<style>
    .progress-tracker {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        margin: 40px auto;
        padding: 0;
        list-style: none;
    }

    .progress-step {
        display: block;
        position: relative;
        -webkit-box-flex: 1;
        -ms-flex: 1 1 0%;
        flex: 1 1 0%;
        margin: 0;
        padding: 0;
        min-width: 28px;
    }

    .progress-step:last-child {
        -webkit-box-flex: 0;
        -ms-flex-positive: 0;
        flex-grow: 0;
    }

    .progress-step:not(:last-child)::after {
        content: '';
        display: block;
        position: absolute;
        z-index: -10;
        top: 12px;
        bottom: 12px;
        right: -14px;
        width: 100%;
        height: 4px;
        -webkit-transition: background-color 0.3s;
        transition: background-color 0.3s;
    }

    .progress-step.is-active .progress-title {
        font-weight: 400;
    }

    .progress-step > a {
        display: block;
    }

    .progress-marker {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        position: relative;
        z-index: 20;
        width: 28px;
        height: 28px;
        padding-bottom: 2px;
        color: #fff;
        font-weight: 400;
        border: 2px solid transparent;
        border-radius: 50%;
        -webkit-transition: background-color, border-color;
        transition: background-color, border-color;
        -webkit-transition-duration: 0.3s;
        transition-duration: 0.3s;
    }

    .progress-text {
        display: block;
        padding: 14px 9.3333333333px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .progress-title {
        margin-top: 0;
    }

    .progress-step .progress-marker {
        color: #fff;
        background-color: #b6b6b6;
    }

    .progress-step::after {
        background-color: #b6b6b6;
    }

    .progress-step .progress-text, .progress-step .progress-step > a .progress-text {
        color: #333333;
    }

    .progress-step.is-active .progress-marker {
        background-color: #2196F3;
    }

    .progress-step.is-complete .progress-marker {
        background-color: greenyellow;
    }

    .progress-step.is-complete::after {
        background-color: green;
    }

    .progress-step.is-complete:hover .progress-marker {
        background-color: green;
    }

    .progress-step:hover .progress-marker {
        background-color: #56ADF5;
    }

    .progress-tracker--center .progress-step {
        text-align: center;
    }

    .progress-tracker--center .progress-step:last-child {
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
    }

    .progress-tracker--center .progress-step::after {
        right: -50%;
    }

    .progress-tracker--center .progress-marker {
        margin-left: auto;
        margin-right: auto;
    }

    .progress-tracker--right .progress-step {
        text-align: right;
    }

    .progress-tracker--right .progress-step:last-child {
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
    }

    .progress-tracker--right .progress-step::after {
        right: calc(-100% + 14px);
    }

    .progress-tracker--right .progress-marker {
        margin-left: auto;
    }

    .progress-tracker--border {
        padding: 5px;
        border: 2px solid #868686;
        border-radius: 38px;
    }

    .progress-tracker--spaced .progress-step::after {
        width: calc(100% - 48px);
        margin-right: 24px;
    }

    .progress-tracker--word {
        padding-right: 38.6666666667px;
        overflow: hidden;
    }

    .progress-tracker--word .progress-text {
        display: inline-block;
        white-space: nowrap;
    }

    .progress-tracker--word .progress-title {
        margin: 0;
    }

    .progress-tracker--word-center {
        padding-right: 38.6666666667px;
        padding-left: 38.6666666667px;
    }

    .progress-tracker--word-center .progress-text {
        padding-right: 0;
        padding-left: 0;
        -webkit-transform: translateX(calc(-50% + 14px));
        transform: translateX(calc(-50% + 14px));
    }

    .progress-tracker--word-right {
        padding-right: 0;
        padding-left: 38.6666666667px;
    }

    .progress-tracker--word-right .progress-text {
        padding-left: 0;
        -webkit-transform: translateX(calc(-100% + 28px));
        transform: translateX(calc(-100% + 28px));
    }

    .progress-tracker--text .progress-step:last-child {
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
    }

    .progress-tracker--text-top .progress-step::after {
        top: auto;
    }

    .progress-tracker--text-top .progress-text {
        height: 100%;
    }

    .progress-tracker--text-top .progress-marker {
        bottom: 28px;
    }

    .progress-tracker--text-inline .progress-step {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }

    .progress-tracker--text-inline .progress-text {
        position: relative;
        z-index: 30;
        max-width: 70%;
        white-space: nowrap;
        padding-top: 0;
        padding-bottom: 0;
        background-color: #fff;
    }

    .progress-tracker--text-inline .progress-title {
        margin: 0;
    }

    .progress-tracker--square .progress-step {
        padding-top: 0;
    }

    .progress-tracker--square .progress-marker {
        -webkit-transform: scaleX(0.33) translateY(-12px);
        transform: scaleX(0.33) translateY(-12px);
        border-radius: 0;
    }

    @media (max-width: 399px) {
        .progress-tracker-mobile {
            overflow-x: auto;
        }
        .progress-tracker-mobile .progress-tracker {
            min-width: 200%;
        }
    }

    .progress-tracker--vertical {
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
    }

    .progress-tracker--vertical .progress-step {
        -webkit-box-flex: 1;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
    }

    .progress-tracker--vertical .progress-step::after {
        right: auto;
        top: 14px;
        left: 12px;
        width: 4px;
        height: 100%;
    }

    .progress-tracker--vertical .progress-marker {
        position: absolute;
        left: 0;
    }

    .progress-tracker--vertical .progress-text {
        padding-top: 7px;
        padding-left: 42px;
    }

    .progress-tracker--vertical .progress-step:not(:last-child) .progress-text {
        padding-bottom: 15px;
    }
</style>