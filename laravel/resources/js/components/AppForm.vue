<template>
    <div class="">
        <el-container>
            <el-main>
                <el-card class="box-card">
                    <el-row :gutter="20">
                        <el-col :xs="24" :sm="12" :md="12" :lg="12" :xl="12">
                            <h1>
                                Welcome to Mars Rover mission
                            </h1>
                            <p class="mt-3">
                                Please send your instructions to move the rover through the Planet. <br/>
                                The rover can move forward (F) and left/right (L, R).

                            </p>

                            <el-form
                                :model="formData"
                                label-width="120px"
                                class="demo-ruleForm"
                                :inline="true"
                                :rules="rules"
                            >
                                <el-form-item label="Instructions" prop="formData.instructions">
                                    <el-input v-model="formData.instructions"/>
                                </el-form-item>

                                <el-form-item>
                                    <el-button
                                        type="primary"
                                        @click="updateInstructions()"
                                    >Send instructions
                                    </el-button
                                    >
                                </el-form-item>
                            </el-form>

                            <el-alert v-if="success" :title="success" type="success" show-icon/>
                            <el-alert v-if="error" :title="error" type="error" show-icon/>


                        </el-col>
                        <el-col :xs="24" :sm="12" :md="12" :lg="12" :xl="12">
                            <el-descriptions
                                title="Rover Data"
                                :column="3"
                                :size="size"
                                border
                                class="mt-2"
                            >
                                <el-descriptions-item>
                                    <template #label>
                                        <div class="cell-item">
                                            <el-icon :style="iconStyle">
                                                <Odometer/>
                                            </el-icon>
                                            Name
                                        </div>
                                    </template>
                                    {{ rover.name }}
                                </el-descriptions-item>
                                <el-descriptions-item v-if="rover.position">
                                    <template #label>
                                        <div class="cell-item">
                                            <el-icon :style="iconStyle">
                                                <AddLocation/>
                                            </el-icon>
                                            X Position
                                        </div>
                                    </template>
                                    {{ rover.position.x }}
                                </el-descriptions-item>
                                <el-descriptions-item v-if="rover.position">
                                    <template #label>
                                        <div class="cell-item">
                                            <el-icon :style="iconStyle">
                                                <AddLocation/>
                                            </el-icon>
                                            Y Position
                                        </div>
                                    </template>
                                    {{ rover.position.y }}
                                </el-descriptions-item>
                            </el-descriptions>

                            <div v-if="rover.instructions" class="mt-3">
                                <h4>
                                    List of instructions sent to Rover
                                </h4>
                                <el-table :data="rover.instructions" border style="width: 100%" class="mt-2">
                                    <el-table-column prop="x" label="X"/>
                                    <el-table-column prop="y" label="Y"/>
                                </el-table>
                            </div>

                            <div v-if="rover.reports" class="mt-3">
                                <h4>
                                    List of obstacles reported
                                </h4>
                                <el-table :data="rover.reports" border style="width: 100%" class="mt-2">
                                    <el-table-column prop="x" label="X"/>
                                    <el-table-column prop="y" label="Y"/>
                                </el-table>
                            </div>
                        </el-col>

                    </el-row>

                </el-card>
            </el-main>
        </el-container>
    </div>
</template>

<script>
import {onMounted, ref, reactive} from "@vue/runtime-core";
import axios from "axios";
import {
    Odometer,
    AddLocation
} from '@element-plus/icons-vue';

export default {
    setup() {
        const formData = reactive({
            "instructions": ref('')
        });

        const rover = ref({});
        const errorMessage = ref('');
        const successMessage = ref('');

        const roverId = 1;

        const rules = reactive({
            instructions: [
                {required: true, message: 'Please set at least one instruction', trigger: 'blur'},
            ],
        });

        async function updateInstructions() {
            let response = await axios({
                method: "post",
                url: '/api/rover/send-instructions',
                params: {
                    "id": roverId,
                    "planet_id": 1,
                    "instructions": formData.instructions.toUpperCase()
                },
            }).then(response => {
                successMessage.value = response.data.message;

                rover.value = response.data.rover;
            }).catch(error => {
                errorMessage.value = error.response.data.message;
            });

            getRover();
        }

        async function getRover() {
            let response = await axios({
                method: "get",
                url: '/api/rover/' + roverId,
            });
            rover.value = response.data;
        }

        onMounted(async () => {
            getRover();
        });

        return {
            formData: formData,
            rover: rover,
            error: errorMessage,
            success: successMessage,
            rules: rules,
            updateInstructions: updateInstructions
        };
    },
    components: {
        Odometer,
        AddLocation
    },
};
</script>
