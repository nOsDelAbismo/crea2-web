/**
 * Created by ander on 27/09/18.
 */

const DEFAULT_ROLES = ['posting', 'active', 'owner', 'memo'];

class Account {

    constructor(username, keys, role) {
        this.username = username;
        this.keys = keys;
        this.role = role;
    }

    /**
     *
     * @param username
     * @param password
     * @param role
     * @returns {Account}
     */
    static generate(username, password, role) {
        if (role) {
            let keys = {};
            if (DEFAULT_ROLES.indexOf(role)) {
                keys[role] = {
                    prv: password,
                    pub: crea.auth.wifToPublic(password)
                };
                return new Account(username, keys, role);
            }

            throw 'Role not valid: ' + roles;
        } else {
            let privKeys = crea.auth.getPrivateKeys(username, password, DEFAULT_ROLES);

            let keys = {
                owner: {
                    prv: privKeys.owner,
                    pub: privKeys.ownerPubkey
                },
                posting: {
                    prv: privKeys.posting,
                    pub: privKeys.postingPubkey
                },
                memo: {
                    prv: privKeys.memo,
                    pub: privKeys.memoPubkey
                },
                active: {
                    prv: privKeys.active,
                    pub: privKeys.activePubkey
                }
            };

            return new Account(username, keys);
        }
    }
}
