/**
 * Created by ander on 25/09/18.
 */

let creaEvents = new EventEmitter();

function goTo(location) {
    window.location.href = location;
}
/**
 *
 * @param {string} location
 */
function toHome(location) {
    console.log('Real location:', window.location.href, 'Checked location:', location, location && window.location.href.indexOf(location) > -1);
    if (location) {
        if (window.location.href.indexOf(location) > -1) {
            goTo('/crea');
        }
    } else {
        goTo('/crea');
    }
}

function createAuth(key) {
    return {
        weight_threshold: 1,
        account_auths: [],
        key_auths: [
            [key, 1]
        ]
    }
}

function createBlockchainAccount(username, password, callback) {
    console.log(password);
    let keys = crea.auth.getPrivateKeys(username, password, DEFAULT_ROLES);
    console.log(keys);

    crea.broadcast.accountCreate(apiOptions.privCreator, "0.001 CREA", apiOptions.accountCreator, username, createAuth(keys.ownerPubkey), createAuth(keys.activePubkey), createAuth(keys.postingPubkey), keys.memoPubkey, {}, function (err, result) {
        console.log(err, result);
        if (callback) {
            callback(err, result);
        }
    });
}

function makeVote(post) {
    let session = Session.getAlive();
    if (session) {
        crea.broadcast.vote(session.account.keys.active.prv, session.account.username, post.author, post.permlink, 100, function (err, result) {
            if (err) {
                console.error(err);
            } else {
                console.log(result);
            }
        })
    }

    return false;
}

function refreshAccessToken(callback) {
    let now = new Date().getTime();
    let expiration = localStorage.getItem(CREARY.ACCESS_TOKEN_EXPIRATION);

    if (!expiration || expiration <= now) {
        let url = 'https://platform.creativechain.net/oauth/v2/token';
        let http = new HttpClient(url);

        let params = {
            grant_type: 'client_credentials',
            client_id: '1_4juuakri1zqckgo444ows4gckw08so0w848sowkckk40wo8w80',
            client_secret: '5co2o9zprcgskcw0ok4ko0csocwkc44swsko4k0kwks04o0koo'
        };

        http.on('done', function (data) {
            data = JSON.parse(data);
            console.log(data);
            localStorage.setItem(CREARY.ACCESS_TOKEN, data.access_token);
            localStorage.setItem(CREARY.ACCESS_TOKEN_EXPIRATION, new Date().getTime() + (data.expires_in * 1000));

            if (callback) {
                callback(data.access_token)
            }
        });

        http.post(params);
    } else if (callback) {
        let accessToken = localStorage.getItem(CREARY.ACCESS_TOKEN);
        callback(accessToken);
    }

}

