<template>
    <div class="tabs-component">
        <ul role="tablist" class="tabs-component-tabs">
            <li
            v-for="(tab, i) in tabs"
            :key="i"
            :class="{ 'is-active': tab.isActive, 'is-disabled': tab.isDisabled }"
            class="tabs-component-tab"
            role="presentation"
            v-show="tab.isVisible"
            ref="tab.hash"
            >
                <a v-html="tab.header"
                :aria-controls="tab.hash"
                :aria-selected="tab.isActive"
                @click="selectTab(tab.hash, $event)"
                :href="tab.hash"
                class="tabs-component-tab-a"
                role="tab"
                ></a>
            </li>
        </ul>
        <div class="tabs-component-panels">
            <slot/>
        </div>
    </div>
</template>



<script>
/*
	class ExpiringStorage {
	    get(key) {
	        const cached = JSON.parse(
	            localStorage.getItem(key)
	        );

	        if (! cached) {
	            return null;
	        }

	        const expires = new Date(cached.expires);

	        if (expires < new Date()) {
	            localStorage.removeItem(key);
	            return null;
	        }

	        return cached.value;
	    }

	    set(key, value, lifeTimeInMinutes) {
	        const currentTime = new Date().getTime();

	        const expires = new Date(currentTime + lifeTimeInMinutes * 60000);

	        localStorage.setItem(key, JSON.stringify({ value, expires }));
	    }
	}
	new ExpiringStorage();*/

	export default {
        props: {
          cacheLifetime: {
            default: 5,
        },
        options: {
            type: Object,
            required: false,
            default: () => ({
              useUrlFragment: true,
              defaultTabHash: null,
                }),
            },
        },

        data() {
            return {
                tabs: []
            }
        },
        created() {
            this.tabs = this.$children;
            //console.log(this.$children[0].hash);
            if (this.$children.length > 0) {
                //console.log('>0');
            }
            else {
                //console.log(this.tabs.length);
            }
            //selectTab(tab.hash, $event)        
        },
        mounted() {
            window.addEventListener('hashchange', () => this.selectTab(window.location.hash));
            if (this.findTab(window.location.hash)) {
                this.selectTab(window.location.hash);
                return;
            }
            const previousSelectedTabHash = expiringStorage.get(this.storageKey);
            if (this.findTab(previousSelectedTabHash)) {
                this.selectTab(previousSelectedTabHash);
                return;
            }
            if(this.options.defaultTabHash !== null && this.findTab("#" + this.options.defaultTabHash)) {
                this.selectTab("#" + this.options.defaultTabHash);
                return;
            }
            if (this.tabs.length) {
                this.selectTab(this.tabs[0].hash);
            }
        },
        methods: {
            findTab(hash) {
                return this.tabs.find(tab => tab.hash === hash);
            },
            selectTab(selectedTabHash, event) {
                // See if we should store the hash in the url fragment.
                if (event && !this.options.useUrlFragment) {
                    event.preventDefault();
                }

        methods: {

            findTab(hash) {
                return this.tabs.find(tab => tab.hash === hash);
            },
            selectTab(selectedTabHash, event) {
                console.log(selectedTabHash);
                // See if we should store the hash in the url fragment.
                if (event && !this.options.useUrlFragment) {
                    event.preventDefault();
                }
                const selectedTab = this.findTab(selectedTabHash);
                if (! selectedTab) {
                    return;
                }
                if (selectedTab.isDisabled) {
                    event.preventDefault();
                    return;
                }
                if (this.lastActiveTabHash === selectedTab.hash) {
                    this.$emit('clicked', { tab: selectedTab });
                    return;
                }
                this.tabs.forEach(tab => {
                        tab.isActive = (tab.hash === selectedTab.hash);
                });
                this.$emit('changed', { tab: selectedTab });
                this.activeTabHash = selectedTab.hash;
                this.activeTabIndex = this.getTabIndex(selectedTabHash);
                this.lastActiveTabHash = this.activeTabHash = selectedTab.hash;
                //expiringStorage.set(this.storageKey, selectedTab.hash, this.cacheLifetime);
            },
            setTabVisible(hash, visible) {
                const tab = this.findTab(hash);
                if (! tab) {
                    return;
                }
                tab.isVisible = visible;
                if (tab.isActive) {
                    // If tab is active, set a different one as active.
                    tab.isActive = visible;
                    this.tabs.every((tab, index, array) => {
                        if (tab.isVisible) {
                            tab.isActive = true;
                            return false;
                        }
                        return true;
                    });
                }
            },

            getTabIndex(hash){
                const tab = this.findTab(hash);

                return this.tabs.indexOf(tab);
            },

            getTabHash(index){
                const tab = this.tabs.find(tab => this.tabs.indexOf(tab) === index);

                if (!tab) {
                    return;
                }

                return tab.hash;
            },

            getActiveTab(){
                return this.findTab(this.activeTabHash);
            },

            getActiveTabIndex() {
                return this.getTabIndex(this.activeTabHash);
            },
        },	
    };

</script>



<style>
   .tabs-component {
      /*margin: 2em 0;*/
  }

  .tabs-component-tabs {
      border: solid 1px #ddd;
      border-radius: 6px;
      margin-bottom: 5px;
  }

  @media (min-width: 700px) {
      .tabs-component-tabs {
        border: 0;
        align-items: stretch;
        display: flex;
        justify-content: flex-start;
        margin-bottom: -1px;
    }
}

.tabs-component-tab {
  color: #999;
  font-size: 14px;
  font-weight: 600;
  margin-right: 0;
  list-style: none;
}

.tabs-component-tab:not(:last-child) {
  border-bottom: dotted 1px #ddd;
}

.tabs-component-tab:hover {
  color: #666;
}

.tabs-component-tab.is-active {
  color: #000;
}

.tabs-component-tab.is-disabled * {
  color: #cdcdcd;
  cursor: not-allowed !important;
}

@media (min-width: 700px) {
  .tabs-component-tab {
    background-color: #fff;
    border: solid 1px #ddd;
    border-radius: 3px 3px 0 0;
    margin-right: .5em;
    transform: translateY(2px);
    transition: transform .3s ease;
}

.tabs-component-tab.is-active {
    border-bottom: solid 1px #fff;
    z-index: 2;
    transform: translateY(0);
}
}

.tabs-component-tab-a {
  align-items: center;
  color: inherit;
  display: flex;
  padding: .75em 1em;
  text-decoration: none;
}

.tabs-component-panels {
  padding: 4em 0;
}

@media (min-width: 700px) {
  .tabs-component-panels {
    border-top-left-radius: 0;
    background-color: #fff;
    border: solid 1px #ddd;
    border-radius: 0 6px 6px 6px;
    box-shadow: 0 0 10px rgba(0, 0, 0, .05);
    padding: 4em 2em;
}
}


</style>