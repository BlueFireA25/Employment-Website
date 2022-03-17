<template>
    <div>
        <ul class="flex flex-wrap justify-center">
            <li v-for="( skill, i ) in this.skills" v-bind:key="i" class="border border-gray-500 px-10 py-3 mb-3 rounded mr-4" @click="activate($event)" :class="checkActiveClass(skill)">{{ skill }}</li>
        </ul>

        <input type="hidden" name="skills" id="skills">
    </div>
</template>

<script>
    var colorSkillList = 'bg-teal-400';

    export default {
        props: ['skills', 'oldskills'],
        data: function() {
            return {
                ability: new Set()
            }
        },
        created: function() {
            if(this.oldskills){
                const skillsArray = this.oldskills.split(',');
                skillsArray.forEach(skill => this.ability.add(skill));
            }
        },
        mounted: function() {
            console.log(this.oldskills)
            document.querySelector('#skills').value = this.oldskills;
        },
        methods: {
            activate(e) {
                if(e.target.classList.contains(colorSkillList)) {
                    // Skill activate
                    e.target.classList.remove(colorSkillList);

                    // Delete to skill set
                    this.ability.delete(e.target.textContent);
                } else {
                    // Skill it is not active, add it
                    e.target.classList.add(colorSkillList);   

                    // Add to skill set
                    this.ability.add(e.target.textContent);
                }

                // Add the skill to input hidden
                const stringSkills = [...this.ability];
                document.querySelector('#skills').value = stringSkills;
            },

            checkActiveClass(skill) {
                return this.ability.has(skill) ? colorSkillList : '';
            }
        }
    }
</script>