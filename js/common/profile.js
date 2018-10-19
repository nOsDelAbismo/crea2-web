/**
 * Created by ander on 25/09/18.
 */

let profileContainer;

(function () {
    let defaultProfile = {
        avatar: {},
        publicName: '',
        about: '',
        web: '',
        contact: '',
        tags: [],
        adultContent: 0,
        lang: 'en',
        valid: true
    };

    function tags(element) {
        $('#' + element).tagsinput();
    }

    function updateProfileView(data, session, account, usernameFilter) {
        if (!profileContainer) {
            profileContainer = new Vue({
                el: '#profile-container',
                data: {
                    CONSTANTS: CONSTANTS,
                    lang: lang,
                    session: session,
                    account: account,
                    data: data,
                    filter: usernameFilter,
                    profile: defaultProfile,
                    navfilter: 'projects'
                },
                updated: function () {
                    console.log('Mounted! ');
                    $('#profile-edit-tags').tagsinput({
                        maxTags: CONSTANTS.MAX_TAGS,
                        maxChars: CONSTANTS.TEXT_MAX_SIZE.TAG,
                        delimiter: ' '
                    });

                },
                methods: {
                    getJoinDate: function () {
                        let date = new Date(this.account.created);
                        return this.lang.PROFILE.JOINED + moment(date.getTime(), 'x').format('MMMM YYYY');
                    },
                    userHasVote: function (post) {
                        let session = Session.getAlive();

                        if (session) {
                            let activeVotes = post.active_votes;

                            for (let x = 0; x < activeVotes.length; x++) {
                                let vote = activeVotes[x];
                                if (session.account.username === vote.voter) {
                                    return true;
                                }
                            }
                        }

                        return false;
                    },
                    getFutureDate: function (date) {
                        date = new Date(date);
                        return moment(date.getTime(), 'x').endOf('day').fromNow();
                    },
                    makeVote: function (post) {
                        let filter = this.filter;
                        makeVote(post, function () {
                            setUpProfile();
                        })
                    },
                    getLicense(flag) {
                        if (flag) {
                            return License.fromFlag(flag);
                        }

                        return new License(LICENSE.FREE_CONTENT);
                    },
                    updateProfile: updateProfile
                }
            });
        } else {
            if (session) {
                profileContainer.session = session;
            }

            if (account) {
                profileContainer.account = account;
            }

            profileContainer.data = data;
            profileContainer.filter = usernameFilter;
            profileContainer.$forceUpdate();
        }
    }

    function updateProfile() {
        let session = Session.getAlive();
        let metadata = profileContainer.profile;
        metadata.tags = $('#profile-edit-tags').val().split(' ');
        metadata = jsonstring(metadata);
        crea.broadcast.accountUpdate(session.account.keys.owner.prv, session.account.username,
            createAuth(session.account.keys.owner.pub), createAuth(session.account.keys.active.pub),
            createAuth(session.account.keys.posting.pub), session.account.keys.memo.pub,
            metadata, function (err, result) {
                if (err) {
                    console.error(err);
                } else {
                    setUpProfile();
                }
            })
    }

    /**
     *
     * @param {Session} session
     * @param account
     * @param {string} usernameFilter
     */
    function showProfile(session, account, usernameFilter) {
        if (!usernameFilter) {
            usernameFilter = '/@' + session.account.username;
        }

        crea.api.getState(usernameFilter, function (err, data) {
            if (err) {
                console.error(err);
            } else  {
                console.log(data);
                let accounts = Object.keys(data.accounts);

                accounts.forEach(function (k) {
                    data.accounts[k].metadata = jsonify(data.accounts[k].json_metadata);
                });

                let posts = Object.keys(data.content);

                posts.forEach(function (k) {
                    data.content[k].metadata = jsonify(data.content[k].json_metadata);
                });

                data.discussion_idx = {};
                posts.sort(function (k1, k2) {
                    let d1 = new Date(data.content[k1].created);
                    let d2 = new Date(data.content[k2].created);

                    return d2.getTime() - d1.getTime();
                });

                data.discussion_idx[''] = posts;

                defaultProfile =  data.accounts[session.account.username].metadata;

                updateProfileView(data, session, account, usernameFilter);
            }
        });
    }

    function updateProfileAccount(session, account) {
        if (!session) {
            session = Session.getAlive();
        }
        crea.api.getFollowCount(session.account.username, function(err, result) {
            if (err) {
                console.error(err);
            } else {

                account.followers_count = result.follower_count;
                account.following_count = result.following_count;
                showProfile(session, account);
            }
        });
    }

    function setUpProfile() {
        let session = Session.getAlive();
        if (session) {
            crea.api.getAccounts([session.account.username], function (err, result) {

                if (err) {
                    console.error(err);
                    //TODO: Show an error
                } else if (result.length > 0) {
                    let account = result[0];
                    account.cgy_balance = '0.000 ' + apiOptions.symbol.CGY;
                    updateProfileAccount(session, account);
                } else {
                    //TODO: Account not exists
                }
            });

        } else {
            //Not logged, redirect to Home if location is wallet.php
            toHome('profile.php');
        }
    }

    setUpProfile();
})();
