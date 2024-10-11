-- Adminer 4.8.1 PostgreSQL 14.5 dump

DROP TABLE IF EXISTS "acreditacion_residencias";
DROP SEQUENCE IF EXISTS acreditacion_residencias_id_seq;
CREATE SEQUENCE acreditacion_residencias_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."acreditacion_residencias" (
    "id" bigint DEFAULT nextval('acreditacion_residencias_id_seq') NOT NULL,
    "acreditacion" character varying(255) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "acreditacion_residencias_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "acreditacion_residencias" ("id", "acreditacion", "created_at", "updated_at") VALUES
(1,	'CUADRO TRIBUTARIO',	'2024-10-04 17:40:27',	'2024-10-04 17:40:27'),
(2,	'SUSTENTO RESIDENCIA',	'2024-10-04 17:40:44',	'2024-10-04 17:40:44'),
(3,	'NINGUNO',	'2024-10-04 17:40:44',	'2024-10-04 17:40:44');

DROP TABLE IF EXISTS "alumnos";
DROP SEQUENCE IF EXISTS alumnos_id_seq;
CREATE SEQUENCE alumnos_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."alumnos" (
    "id" bigint DEFAULT nextval('alumnos_id_seq') NOT NULL,
    "persona_id" bigint NOT NULL,
    "genero_id" bigint NOT NULL,
    "anio_ingreso_id" bigint NOT NULL,
    "tipo_seguro_id" bigint NOT NULL,
    "cond_socio_economica_id" bigint NOT NULL,
    "manif_volunta_id" bigint NOT NULL,
    "acred_resid_id" bigint NOT NULL,
    "tipo_discapacidad_id" bigint NOT NULL,
    "fecha_inscripcion" date NOT NULL,
    "ds_exp_inscripcion" character varying(25) NOT NULL,
    "distrito" character varying(30) NOT NULL,
    "sector" character varying(5) NOT NULL,
    "subsector" character varying(5) NOT NULL,
    "domicilio" character varying(150) NOT NULL,
    "fecha_nacimiento" date NOT NULL,
    "ro_carnet_conadis" character varying(20) NOT NULL,
    "solicitud_inscripcion" boolean DEFAULT false NOT NULL,
    "cons_empadronamiento_sisfoh" character varying(10) NOT NULL,
    "copia_dni" boolean DEFAULT false NOT NULL,
    "informe_medico" boolean DEFAULT false NOT NULL,
    "recibo_serv" boolean DEFAULT false NOT NULL,
    "copia_carnet_conadis" boolean DEFAULT false NOT NULL,
    "documentacion_digital" boolean DEFAULT false NOT NULL,
    "deleted_at" timestamp(0),
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "alumnos_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "alumnos" ("id", "persona_id", "genero_id", "anio_ingreso_id", "tipo_seguro_id", "cond_socio_economica_id", "manif_volunta_id", "acred_resid_id", "tipo_discapacidad_id", "fecha_inscripcion", "ds_exp_inscripcion", "distrito", "sector", "subsector", "domicilio", "fecha_nacimiento", "ro_carnet_conadis", "solicitud_inscripcion", "cons_empadronamiento_sisfoh", "copia_dni", "informe_medico", "recibo_serv", "copia_carnet_conadis", "documentacion_digital", "deleted_at", "created_at", "updated_at") VALUES
(1,	4,	1,	10,	1,	1,	1,	1,	5,	'2024-10-01',	'OK',	'SANTIAGO DE SURCO',	'1',	'1.2',	'AV MONTE DE LOS OLIVOS 545',	'1992-06-26',	'OK123',	't',	'OK',	't',	't',	't',	't',	't',	NULL,	'2024-10-04 17:43:20',	'2024-10-04 17:43:20'),
(2,	5,	2,	8,	4,	3,	2,	1,	1,	'2023-03-20',	'162-2023/OMAPED',	'SANTIAGO DE SURCO',	'2',	'2.4',	'JR. VILLA LARIENA 272 ',	'2021-01-06',	'419923',	'f',	'SI',	't',	'f',	't',	't',	'f',	NULL,	'2024-10-10 09:36:40',	'2024-10-10 09:36:40'),
(3,	6,	1,	1,	4,	3,	3,	3,	1,	'2023-03-20',	'161-2023/OMAPED',	'SANTIAGO DE SURCO',	'2',	'2.3',	'AV. LAS GAVIOTAS MZ. C LT1',	'1992-10-26',	'',	'f',	'NO',	'f',	'f',	'f',	'f',	'f',	NULL,	'2024-10-10 10:08:37',	'2024-10-10 10:08:37'),
(4,	7,	1,	1,	1,	1,	2,	1,	1,	'2023-03-20',	'158-2023/OMAPED',	'SANTIAGO DE SURCO',	'3',	'3.1',	'MZ B LOTE 6 ASOC. VIV. CANEVARO',	'2011-01-04',	'00884-M-2021',	'f',	'SI',	't',	't',	't',	't',	'f',	NULL,	'2024-10-10 10:18:09',	'2024-10-10 10:18:09'),
(5,	8,	1,	1,	4,	3,	2,	1,	1,	'2023-03-20',	'149-2023/OMAPED',	'SANTIAGO DE SURCO',	'3',	'3.1',	'BAYOVAR MZ E4 LOTE 17 PROL. BENAVIDES',	'1999-01-10',	'342331',	'f',	'NO',	't',	'f',	't',	'f',	'f',	NULL,	'2024-10-10 10:23:31',	'2024-10-10 10:23:31'),
(6,	9,	1,	1,	1,	3,	2,	1,	1,	'2023-03-20',	'148-2023/OMAPED',	'SANTIAGO DE SURCO',	'2',	'2.4',	'CALLE LA QUEBRANTA 157 URB. LA TALARA',	'2013-05-04',	'NO',	'f',	'CADUCADO',	't',	't',	't',	't',	'f',	NULL,	'2024-10-10 10:30:56',	'2024-10-10 10:30:56'),
(7,	10,	2,	7,	4,	3,	1,	1,	1,	'2023-03-20',	'147-2023/OMAPED',	'SANTIAGO DE SURCO',	'',	'',	'TACNA 463 INT 7',	'1991-11-10',	'06103-2006',	'f',	'',	't',	'f',	't',	'f',	'f',	NULL,	'2024-10-10 10:54:36',	'2024-10-10 10:54:36');

DROP TABLE IF EXISTS "anio_ingresos";
DROP SEQUENCE IF EXISTS anio_ingresos_id_seq;
CREATE SEQUENCE anio_ingresos_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."anio_ingresos" (
    "id" bigint DEFAULT nextval('anio_ingresos_id_seq') NOT NULL,
    "periodo_id" bigint NOT NULL,
    "anio" character varying(4) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "anio_ingresos_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "anio_ingresos" ("id", "periodo_id", "anio", "created_at", "updated_at") VALUES
(1,	1,	'2020',	'2024-10-04 21:55:20',	'2024-10-04 21:55:20'),
(2,	2,	'2020',	'2024-10-04 21:55:20',	'2024-10-04 21:55:20'),
(3,	1,	'2021',	'2024-10-04 21:55:20',	'2024-10-04 21:55:20'),
(4,	2,	'2021',	'2024-10-04 21:55:20',	'2024-10-04 21:55:20'),
(5,	1,	'2022',	'2024-10-04 21:55:20',	'2024-10-04 21:55:20'),
(6,	2,	'2022',	'2024-10-04 21:55:20',	'2024-10-04 21:55:20'),
(7,	1,	'2023',	'2024-10-04 21:55:20',	'2024-10-04 21:55:20'),
(8,	2,	'2023',	'2024-10-04 21:55:20',	'2024-10-04 21:55:20'),
(9,	1,	'2024',	'2024-10-04 21:55:20',	'2024-10-04 21:55:20'),
(10,	2,	'2024',	'2024-10-04 21:55:20',	'2024-10-04 21:55:20');

DROP TABLE IF EXISTS "asistencias";
DROP SEQUENCE IF EXISTS asistencias_id_seq;
CREATE SEQUENCE asistencias_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."asistencias" (
    "id" bigint DEFAULT nextval('asistencias_id_seq') NOT NULL,
    "inscripcion_id" bigint NOT NULL,
    "fecha" timestamp(0) NOT NULL,
    "asistio" boolean DEFAULT false NOT NULL,
    "justificada" boolean DEFAULT false NOT NULL,
    "motivo" character varying(350),
    "usuario_actualiza" character varying(50),
    "deleted_at" timestamp(0),
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "asistencias_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "certificado_discapacidads";
DROP SEQUENCE IF EXISTS certificado_discapacidads_id_seq;
CREATE SEQUENCE certificado_discapacidads_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."certificado_discapacidads" (
    "id" bigint DEFAULT nextval('certificado_discapacidads_id_seq') NOT NULL,
    "alumno_id" bigint NOT NULL,
    "emision_cert_discapacidad" character varying(20) NOT NULL,
    "vigencia_cert_discapacidad" character varying(20) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "certificado_discapacidads_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "ciclo_horarios";
DROP SEQUENCE IF EXISTS ciclo_horarios_id_seq;
CREATE SEQUENCE ciclo_horarios_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."ciclo_horarios" (
    "id" bigint DEFAULT nextval('ciclo_horarios_id_seq') NOT NULL,
    "ciclo_id" bigint NOT NULL,
    "horario_id" bigint NOT NULL,
    "cupo_maximo" integer NOT NULL,
    "cupo_actual" integer NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "ciclo_horarios_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "ciclo_horarios" ("id", "ciclo_id", "horario_id", "cupo_maximo", "cupo_actual", "created_at", "updated_at") VALUES
(1,	1,	3,	8,	7,	'2024-10-04 17:18:16',	'2024-10-04 17:18:16'),
(2,	3,	7,	1,	0,	'2024-10-04 17:21:05',	'2024-10-04 17:21:05'),
(3,	4,	6,	8,	7,	'2024-10-04 17:28:28',	'2024-10-04 17:28:28'),
(4,	5,	8,	10,	9,	'2024-10-09 14:53:16',	'2024-10-09 14:53:16'),
(5,	6,	10,	14,	13,	'2024-10-09 14:55:22',	'2024-10-09 14:55:22'),
(6,	7,	11,	8,	7,	'2024-10-09 14:55:22',	'2024-10-09 14:55:22'),
(7,	4,	5,	6,	0,	'2024-10-09 15:56:02',	'2024-10-09 15:56:02');

DROP TABLE IF EXISTS "ciclos";
DROP SEQUENCE IF EXISTS ciclos_id_seq;
CREATE SEQUENCE ciclos_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 2 CACHE 1;

CREATE TABLE "public"."ciclos" (
    "id" bigint DEFAULT nextval('ciclos_id_seq') NOT NULL,
    "taller_id" bigint NOT NULL,
    "periodo_id" bigint NOT NULL,
    "anio" character varying(4) NOT NULL,
    "fecha_inicio" date NOT NULL,
    "fecha_fin" date NOT NULL,
    "usuario_actualiza" character varying(50),
    "estado" boolean DEFAULT true NOT NULL,
    "deleted_at" timestamp(0),
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "ciclos_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "ciclos" ("id", "taller_id", "periodo_id", "anio", "fecha_inicio", "fecha_fin", "usuario_actualiza", "estado", "deleted_at", "created_at", "updated_at") VALUES
(1,	1,	3,	'2024',	'2024-10-15',	'2024-12-15',	NULL,	't',	NULL,	'2024-10-04 17:09:27',	'2024-10-04 17:09:27'),
(2,	1,	1,	'2025',	'2025-01-15',	'2025-03-15',	NULL,	't',	NULL,	'2024-10-04 17:09:51',	'2024-10-04 17:09:51'),
(3,	7,	3,	'2024',	'2024-10-15',	'2024-12-15',	NULL,	't',	NULL,	'2024-10-04 17:20:46',	'2024-10-04 17:20:46'),
(4,	4,	3,	'2024',	'2024-10-15',	'2024-12-15',	NULL,	't',	NULL,	'2024-10-04 17:27:44',	'2024-10-04 17:27:44'),
(5,	15,	3,	'2024',	'2024-06-01',	'2024-09-01',	NULL,	'f',	NULL,	'2024-10-09 12:10:16',	'2024-10-09 12:10:16'),
(6,	21,	3,	'2024',	'2024-10-15',	'2024-12-15',	NULL,	't',	NULL,	'2024-10-09 12:41:55',	'2024-10-09 12:41:55'),
(7,	23,	3,	'2024',	'2024-10-15',	'2024-12-15',	NULL,	't',	NULL,	'2024-10-09 12:42:14',	'2024-10-09 12:42:14');

DROP TABLE IF EXISTS "condicion_socio_economicas";
DROP SEQUENCE IF EXISTS condicion_socio_economicas_id_seq;
CREATE SEQUENCE condicion_socio_economicas_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."condicion_socio_economicas" (
    "id" bigint DEFAULT nextval('condicion_socio_economicas_id_seq') NOT NULL,
    "condicion" character varying(30) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "condicion_socio_economicas_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "condicion_socio_economicas" ("id", "condicion", "created_at", "updated_at") VALUES
(1,	'POBRE',	'2024-10-04 17:38:28',	'2024-10-04 17:38:28'),
(2,	'POBRE EXTREMO',	'2024-10-04 17:38:43',	'2024-10-04 17:38:43'),
(3,	'NO POBRE',	'2024-10-04 17:38:43',	'2024-10-04 17:38:43');

DROP TABLE IF EXISTS "diagnostico_medicos";
DROP SEQUENCE IF EXISTS diagnostico_medicos_id_seq;
CREATE SEQUENCE diagnostico_medicos_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."diagnostico_medicos" (
    "id" bigint DEFAULT nextval('diagnostico_medicos_id_seq') NOT NULL,
    "alumnos_id" bigint NOT NULL,
    "diagnostico" character varying(100) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "diagnostico_medicos_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "dias";
DROP SEQUENCE IF EXISTS dias_id_seq;
CREATE SEQUENCE dias_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."dias" (
    "id" bigint DEFAULT nextval('dias_id_seq') NOT NULL,
    "dia" character varying(100) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "dias_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "dias" ("id", "dia", "created_at", "updated_at") VALUES
(1,	'LUNES',	'2024-10-04 17:07:47',	'2024-10-04 17:07:47'),
(2,	'MARTES',	'2024-10-04 17:08:45',	'2024-10-04 17:08:45'),
(3,	'MIERCOLES',	'2024-10-04 17:08:45',	'2024-10-04 17:08:45'),
(4,	'JUEVES',	'2024-10-04 17:08:45',	'2024-10-04 17:08:45'),
(5,	'VIERNES',	'2024-10-04 17:08:45',	'2024-10-04 17:08:45'),
(6,	'SABADO',	'2024-10-04 17:08:45',	'2024-10-04 17:08:45'),
(7,	'DOMINGO',	'2024-10-04 17:08:45',	'2024-10-04 17:08:45');

DROP TABLE IF EXISTS "encargado_ciclos";
DROP SEQUENCE IF EXISTS encargado_ciclos_id_seq;
CREATE SEQUENCE encargado_ciclos_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."encargado_ciclos" (
    "id" bigint DEFAULT nextval('encargado_ciclos_id_seq') NOT NULL,
    "persona_id" bigint NOT NULL,
    "ciclo_horario_id" bigint NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "encargado_ciclos_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "encargado_ciclos" ("id", "persona_id", "ciclo_horario_id", "created_at", "updated_at") VALUES
(1,	2,	1,	'2024-10-04 17:25:21',	'2024-10-04 17:25:21'),
(2,	2,	2,	'2024-10-04 17:25:36',	'2024-10-04 17:25:36'),
(3,	3,	3,	'2024-10-04 17:29:40',	'2024-10-04 17:29:40'),
(4,	2,	7,	'2024-10-09 15:56:58',	'2024-10-09 15:56:58');

DROP TABLE IF EXISTS "espera_persona_tallers";
DROP SEQUENCE IF EXISTS espera_persona_tallers_id_seq;
CREATE SEQUENCE espera_persona_tallers_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 2 CACHE 1;

CREATE TABLE "public"."espera_persona_tallers" (
    "id" bigint DEFAULT nextval('espera_persona_tallers_id_seq') NOT NULL,
    "persona_id" bigint NOT NULL,
    "taller_id" bigint NOT NULL,
    "inscrito" character varying(1) DEFAULT 'E' NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "espera_persona_tallers_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "espera_persona_tallers" ("id", "persona_id", "taller_id", "inscrito", "created_at", "updated_at") VALUES
(1,	5,	7,	'E',	'2024-10-10 09:42:15',	'2024-10-10 09:42:15'),
(2,	10,	4,	'E',	'2024-10-10 11:39:15',	'2024-10-10 11:39:15');

DROP TABLE IF EXISTS "failed_jobs";
DROP SEQUENCE IF EXISTS failed_jobs_id_seq;
CREATE SEQUENCE failed_jobs_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."failed_jobs" (
    "id" bigint DEFAULT nextval('failed_jobs_id_seq') NOT NULL,
    "uuid" character varying(255) NOT NULL,
    "connection" text NOT NULL,
    "queue" text NOT NULL,
    "payload" text NOT NULL,
    "exception" text NOT NULL,
    "failed_at" timestamp(0) DEFAULT CURRENT_TIMESTAMP NOT NULL,
    CONSTRAINT "failed_jobs_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "failed_jobs_uuid_unique" UNIQUE ("uuid")
) WITH (oids = false);


DROP TABLE IF EXISTS "generos";
DROP SEQUENCE IF EXISTS generos_id_seq;
CREATE SEQUENCE generos_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."generos" (
    "id" bigint DEFAULT nextval('generos_id_seq') NOT NULL,
    "tipo_genero" character varying(15) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "generos_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "generos" ("id", "tipo_genero", "created_at", "updated_at") VALUES
(1,	'MASCULINO',	'2024-10-04 21:55:20',	'2024-10-04 21:55:20'),
(2,	'FEMENINO',	'2024-10-04 21:55:20',	'2024-10-04 21:55:20'),
(3,	'NO INDICADO',	'2024-10-04 21:55:20',	'2024-10-04 21:55:20');

DROP TABLE IF EXISTS "horarios";
DROP SEQUENCE IF EXISTS horarios_id_seq;
CREATE SEQUENCE horarios_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."horarios" (
    "id" bigint DEFAULT nextval('horarios_id_seq') NOT NULL,
    "dia_id" bigint NOT NULL,
    "hora_inicio" character varying(255) NOT NULL,
    "hora_fin" character varying(255) NOT NULL,
    "usuario_actualiza" character varying(50),
    "deleted_at" timestamp(0),
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "horarios_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "horarios" ("id", "dia_id", "hora_inicio", "hora_fin", "usuario_actualiza", "deleted_at", "created_at", "updated_at") VALUES
(1,	5,	'12:00:00',	'13:00:00',	NULL,	NULL,	'2024-10-04 17:11:01',	'2024-10-04 17:11:01'),
(2,	1,	'08:00:00',	'09:00:00',	NULL,	NULL,	'2024-10-04 17:14:00',	'2024-10-04 17:14:00'),
(3,	1,	'10:00:00',	'11:00:00',	NULL,	NULL,	'2024-10-04 17:14:00',	'2024-10-04 17:14:00'),
(4,	3,	'10:00:00',	'11:00:00',	NULL,	NULL,	'2024-10-04 17:14:00',	'2024-10-04 17:14:00'),
(5,	2,	'09:00:00',	'10:00:00',	NULL,	NULL,	'2024-10-04 17:14:00',	'2024-10-04 17:14:00'),
(6,	5,	'10:00:00',	'11:00:00',	NULL,	NULL,	'2024-10-04 17:14:00',	'2024-10-04 17:14:00'),
(7,	4,	'09:30:00',	'10:00:00',	NULL,	NULL,	'2024-10-04 17:17:06',	'2024-10-04 17:17:06'),
(8,	2,	'11:00:00',	'12:00:00',	NULL,	NULL,	'2024-10-09 14:44:10',	'2024-10-09 14:44:10'),
(9,	5,	'08:30:00',	'09:00:00',	NULL,	NULL,	'2024-10-09 14:47:35',	'2024-10-09 14:47:35'),
(10,	3,	'11:00:00',	'12:00:00',	NULL,	NULL,	'2024-10-09 14:47:35',	'2024-10-09 14:47:35'),
(11,	4,	'12:00:00',	'13:00:00',	NULL,	NULL,	'2024-10-09 14:47:35',	'2024-10-09 14:47:35'),
(12,	1,	'12:00:00',	'12:30:00',	NULL,	NULL,	'2024-10-09 14:48:54',	'2024-10-09 14:48:54'),
(13,	1,	'09:00:00',	'09:30:00',	NULL,	NULL,	'2024-10-09 14:48:54',	'2024-10-09 14:48:54'),
(14,	2,	'08:00:00',	'08:30:00',	NULL,	NULL,	'2024-10-09 14:48:54',	'2024-10-09 14:48:54');

DROP TABLE IF EXISTS "inscripcions";
DROP SEQUENCE IF EXISTS inscripcions_id_seq;
CREATE SEQUENCE inscripcions_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."inscripcions" (
    "id" bigint DEFAULT nextval('inscripcions_id_seq') NOT NULL,
    "persona_id" bigint NOT NULL,
    "horario_id" bigint NOT NULL,
    "es_derivado" boolean DEFAULT false NOT NULL,
    "fecha_derivacion" timestamp(0),
    "estado_inscripcion" character varying(1) DEFAULT 'I' NOT NULL,
    "fecha_inscripcion" timestamp(0),
    "usuario_actualiza" character varying(50),
    "deleted_at" timestamp(0),
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "inscripcions_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "inscripcions" ("id", "persona_id", "horario_id", "es_derivado", "fecha_derivacion", "estado_inscripcion", "fecha_inscripcion", "usuario_actualiza", "deleted_at", "created_at", "updated_at") VALUES
(1,	4,	3,	'f',	NULL,	'I',	'2024-10-04 00:00:00',	NULL,	NULL,	'2024-10-04 17:44:10',	'2024-10-04 17:44:10'),
(2,	4,	7,	'f',	NULL,	'I',	'2024-10-04 00:00:00',	NULL,	NULL,	'2024-10-04 17:45:03',	'2024-10-04 17:45:03'),
(3,	4,	8,	'f',	NULL,	'I',	'2024-10-09 00:00:00',	NULL,	NULL,	'2024-10-09 15:47:41',	'2024-10-09 15:47:41'),
(4,	4,	10,	'f',	NULL,	'I',	'2024-10-09 00:00:00',	NULL,	NULL,	'2024-10-09 15:48:07',	'2024-10-09 15:48:07'),
(5,	4,	11,	'f',	NULL,	'I',	'2024-10-09 00:00:00',	NULL,	NULL,	'2024-10-09 15:48:14',	'2024-10-09 15:48:14'),
(6,	4,	5,	'f',	NULL,	'I',	'2024-10-09 00:00:00',	NULL,	NULL,	'2024-10-09 15:58:13',	'2024-10-09 15:58:13'),
(7,	5,	5,	'f',	NULL,	'I',	NULL,	NULL,	NULL,	'2024-10-10 11:35:15',	'2024-10-10 11:35:15'),
(8,	6,	5,	'f',	NULL,	'I',	NULL,	NULL,	NULL,	'2024-10-10 11:36:34',	'2024-10-10 11:36:34'),
(9,	7,	5,	'f',	NULL,	'I',	NULL,	NULL,	NULL,	'2024-10-10 11:36:34',	'2024-10-10 11:36:34'),
(10,	8,	5,	'f',	NULL,	'I',	NULL,	NULL,	NULL,	'2024-10-10 11:36:34',	'2024-10-10 11:36:34'),
(11,	9,	5,	'f',	NULL,	'I',	NULL,	NULL,	NULL,	'2024-10-10 11:36:34',	'2024-10-10 11:36:34');

DROP TABLE IF EXISTS "manifestacion_voluntads";
DROP SEQUENCE IF EXISTS manifestacion_voluntads_id_seq;
CREATE SEQUENCE manifestacion_voluntads_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."manifestacion_voluntads" (
    "id" bigint DEFAULT nextval('manifestacion_voluntads_id_seq') NOT NULL,
    "manifestacion" character varying(60) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "manifestacion_voluntads_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "manifestacion_voluntads" ("id", "manifestacion", "created_at", "updated_at") VALUES
(1,	'ACTA COMPROMISO',	'2024-10-04 17:39:23',	'2024-10-04 17:39:23'),
(2,	'DECLARACION JURADA',	'2024-10-04 17:39:23',	'2024-10-04 17:39:23'),
(3,	'NINGUNO',	'2024-10-04 17:39:23',	'2024-10-04 17:39:23');

DROP TABLE IF EXISTS "migrations";
DROP SEQUENCE IF EXISTS migrations_id_seq;
CREATE SEQUENCE migrations_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 29 CACHE 1;

CREATE TABLE "public"."migrations" (
    "id" integer DEFAULT nextval('migrations_id_seq') NOT NULL,
    "migration" character varying(255) NOT NULL,
    "batch" integer NOT NULL,
    CONSTRAINT "migrations_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "migrations" ("id", "migration", "batch") VALUES
(1,	'2014_10_10_000000_create_tipo_personas_table',	1),
(2,	'2014_10_11_000000_create_personas_table',	1),
(3,	'2014_10_12_000000_create_users_table',	1),
(4,	'2014_10_12_100000_create_password_resets_table',	1),
(5,	'2019_08_19_000000_create_failed_jobs_table',	1),
(6,	'2019_12_14_000001_create_personal_access_tokens_table',	1),
(7,	'2024_09_27_212115_create_generos_table',	1),
(8,	'2024_09_27_212149_create_periodos_table',	1),
(9,	'2024_09_27_212211_create_anio_ingresos_table',	1),
(10,	'2024_09_27_212423_create_tipo_seguros_table',	1),
(11,	'2024_09_27_212451_create_condicion_socio_economicas_table',	1),
(12,	'2024_09_27_212523_create_manifestacion_voluntads_table',	1),
(13,	'2024_09_27_212556_create_acreditacion_residencias_table',	1),
(14,	'2024_09_27_212624_create_tipo_discapacidads_table',	1),
(15,	'2024_09_27_212655_create_alumnos_table',	1),
(16,	'2024_09_27_221209_create_certificado_discapacidads_table',	1),
(17,	'2024_09_27_221241_create_diagnostico_medicos_table',	1),
(18,	'2024_09_28_035641_create_representantes_table',	1),
(19,	'2024_09_28_040647_create_tipo_tallers_table',	1),
(20,	'2024_09_28_040710_create_programas_table',	1),
(21,	'2024_09_28_040711_create_tallers_table',	1),
(22,	'2024_09_28_040801_create_dias_table',	1),
(23,	'2024_09_28_040843_create_ciclos_table',	1),
(24,	'2024_09_28_040900_create_horarios_table',	1),
(25,	'2024_09_28_040935_create_inscripcions_table',	1),
(26,	'2024_09_28_041002_create_asistencias_table',	1),
(27,	'2024_10_04_205412_create_ciclo_horarios_table',	1),
(28,	'2024_10_04_210432_create_encargado_ciclos_table',	1),
(29,	'2024_10_04_213112_create_espera_persona_tallers_table',	1);

DROP TABLE IF EXISTS "password_resets";
CREATE TABLE "public"."password_resets" (
    "email" character varying(255) NOT NULL,
    "token" character varying(255) NOT NULL,
    "created_at" timestamp(0)
) WITH (oids = false);

CREATE INDEX "password_resets_email_index" ON "public"."password_resets" USING btree ("email");


DROP TABLE IF EXISTS "periodos";
DROP SEQUENCE IF EXISTS periodos_id_seq;
CREATE SEQUENCE periodos_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."periodos" (
    "id" bigint DEFAULT nextval('periodos_id_seq') NOT NULL,
    "periodo" character varying(4) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "periodos_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "periodos" ("id", "periodo", "created_at", "updated_at") VALUES
(1,	'I',	'2024-10-04 21:55:20',	'2024-10-04 21:55:20'),
(2,	'II',	'2024-10-04 21:55:20',	'2024-10-04 21:55:20'),
(3,	'III',	'2024-10-04 21:55:20',	'2024-10-04 21:55:20'),
(4,	'IV',	'2024-10-09 11:55:34',	'2024-10-09 11:55:34');

DROP TABLE IF EXISTS "personal_access_tokens";
DROP SEQUENCE IF EXISTS personal_access_tokens_id_seq;
CREATE SEQUENCE personal_access_tokens_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."personal_access_tokens" (
    "id" bigint DEFAULT nextval('personal_access_tokens_id_seq') NOT NULL,
    "tokenable_type" character varying(255) NOT NULL,
    "tokenable_id" bigint NOT NULL,
    "token" character varying(64) NOT NULL,
    "abilities" text,
    "last_used_at" timestamp(0),
    "expires_at" timestamp(0),
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "personal_access_tokens_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "personal_access_tokens_token_unique" UNIQUE ("token")
) WITH (oids = false);

CREATE INDEX "personal_access_tokens_tokenable_type_tokenable_id_index" ON "public"."personal_access_tokens" USING btree ("tokenable_type", "tokenable_id");


DROP TABLE IF EXISTS "personas";
DROP SEQUENCE IF EXISTS personas_id_seq;
CREATE SEQUENCE personas_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."personas" (
    "id" bigint DEFAULT nextval('personas_id_seq') NOT NULL,
    "tipo_persona_id" bigint NOT NULL,
    "documento" character varying(12) NOT NULL,
    "nombres" character varying(50) NOT NULL,
    "apellidos" character varying(100) NOT NULL,
    "deleted_at" timestamp(0),
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "personas_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "personas" ("id", "tipo_persona_id", "documento", "nombres", "apellidos", "deleted_at", "created_at", "updated_at") VALUES
(1,	1,	'48398529',	'Sergio Alejandro',	'Corcuera Mel',	NULL,	'2024-10-04 21:55:20',	'2024-10-04 21:55:20'),
(2,	2,	'47680246',	'ALESSANDRA',	'CHAHUA',	NULL,	'2024-10-04 17:23:06',	'2024-10-04 17:23:06'),
(3,	2,	'70124812',	'DIANA',	'HUERTAS',	NULL,	'2024-10-04 17:23:06',	'2024-10-04 17:23:06'),
(4,	6,	'10101048',	'BRAIAN',	'ARRUNATEGUI',	NULL,	'2024-10-04 17:35:02',	'2024-10-04 17:35:02'),
(5,	6,	'92183138',	'SAMIRA KAORI',	'CASTILLO RIOS',	NULL,	'2024-10-10 09:28:38',	'2024-10-10 09:28:38'),
(6,	6,	'47979347',	'MIGUEL ALBERTINI',	'CASTRO HUAMAN ',	NULL,	'2024-10-10 09:51:26',	'2024-10-10 09:51:26'),
(7,	6,	'62716560',	'RODRIGO CLIMACO',	'CCARHUAS AYQUIPA',	NULL,	'2024-10-10 10:15:01',	'2024-10-10 10:15:01'),
(8,	6,	'76638974',	'JHONATHAN CARLOS',	'CORNEJO GUEVARA',	NULL,	'2024-10-10 10:20:13',	'2024-10-10 10:20:13'),
(9,	6,	'78083526',	'RAFFAELE ALESSANDRO',	'CORTINES SANTILLAN',	NULL,	'2024-10-10 10:28:04',	'2024-10-10 10:28:04'),
(10,	6,	'46829450',	'ROSARIO DEL PILAR',	'CRIOLLO LEON',	NULL,	'2024-10-10 10:51:54',	'2024-10-10 10:51:54');

DROP TABLE IF EXISTS "programas";
DROP SEQUENCE IF EXISTS programas_id_seq;
CREATE SEQUENCE programas_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."programas" (
    "id" bigint DEFAULT nextval('programas_id_seq') NOT NULL,
    "nombre" character varying(100) NOT NULL,
    "usuario_actualiza" character varying(50),
    "estado" boolean DEFAULT true NOT NULL,
    "deleted_at" timestamp(0),
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "programas_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "programas" ("id", "nombre", "usuario_actualiza", "estado", "deleted_at", "created_at", "updated_at") VALUES
(1,	'TALLER DE APRENDIZAJE',	NULL,	't',	NULL,	'2024-10-04 16:56:07',	'2024-10-04 16:56:07'),
(2,	'TALLER DE PSICOLOGIA',	NULL,	't',	NULL,	'2024-10-04 16:56:33',	'2024-10-04 16:56:33'),
(3,	'TALLER DE DANZA',	NULL,	't',	NULL,	'2024-10-04 16:56:40',	'2024-10-04 16:56:40'),
(4,	'TALLER DE MÚSICA',	NULL,	't',	NULL,	'2024-10-04 16:56:53',	'2024-10-04 16:56:53'),
(5,	'TALLER DE DEPORTES',	NULL,	't',	NULL,	'2024-10-04 16:57:02',	'2024-10-04 16:57:02'),
(6,	'TALLER DE TERAPIA FISICA Y REHABILITACION',	NULL,	't',	NULL,	'2024-10-04 16:57:09',	'2024-10-04 16:57:09'),
(7,	'TALLER DE LENGUAJE',	NULL,	't',	NULL,	'2024-10-04 16:57:15',	'2024-10-04 16:57:15');

DROP TABLE IF EXISTS "representantes";
DROP SEQUENCE IF EXISTS representantes_id_seq;
CREATE SEQUENCE representantes_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."representantes" (
    "id" bigint DEFAULT nextval('representantes_id_seq') NOT NULL,
    "persona_id" bigint NOT NULL,
    "alumno_id" bigint NOT NULL,
    "telefono" character varying(12),
    "email" character varying(50),
    "usuario_actualiza" character varying(50),
    "deleted_at" timestamp(0),
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "representantes_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "tallers";
DROP SEQUENCE IF EXISTS tallers_id_seq;
CREATE SEQUENCE tallers_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."tallers" (
    "id" bigint DEFAULT nextval('tallers_id_seq') NOT NULL,
    "programa_id" bigint NOT NULL,
    "tipo_taller_id" bigint NOT NULL,
    "nombre" character varying(100) NOT NULL,
    "usuario_actualiza" character varying(50),
    "estado" boolean DEFAULT true NOT NULL,
    "deleted_at" timestamp(0),
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "tallers_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "tallers" ("id", "programa_id", "tipo_taller_id", "nombre", "usuario_actualiza", "estado", "deleted_at", "created_at", "updated_at") VALUES
(1,	1,	1,	'TALLER DE MONEDAS 18+',	NULL,	't',	NULL,	'2024-10-04 16:58:04',	'2024-10-04 16:58:04'),
(2,	1,	1,	'LECTOESCRITURA',	NULL,	't',	NULL,	'2024-10-04 16:59:15',	'2024-10-04 16:59:15'),
(3,	1,	1,	'HABILIDADES COGNITIVAS',	NULL,	't',	NULL,	'2024-10-04 16:59:15',	'2024-10-04 16:59:15'),
(4,	1,	1,	'COMPRENSIÓN LECTORA (SABER LEER)',	NULL,	't',	NULL,	'2024-10-04 16:59:15',	'2024-10-04 16:59:15'),
(5,	1,	1,	'ATENCIÓN Y CONCENTRACIÓN',	NULL,	't',	NULL,	'2024-10-04 16:59:15',	'2024-10-04 16:59:15'),
(6,	1,	1,	'DESARROLLO DE COMPRENSIÓN LECTORA (APRENDER A LEER)',	NULL,	't',	NULL,	'2024-10-04 16:59:15',	'2024-10-04 16:59:15'),
(7,	2,	2,	'HABILIDADES SOCIALES',	NULL,	't',	NULL,	'2024-10-04 17:01:19',	'2024-10-04 17:01:19'),
(8,	2,	2,	'HABILIDADES LABORALES',	NULL,	't',	NULL,	'2024-10-04 17:01:19',	'2024-10-04 17:01:19'),
(9,	2,	1,	'TALLER DE TALENTOS (MANUALIDADES)',	NULL,	't',	NULL,	'2024-10-04 17:01:19',	'2024-10-04 17:01:19'),
(10,	2,	2,	'TALLER DE AUTOCUIDADO PERSONAL',	NULL,	't',	NULL,	'2024-10-04 17:01:19',	'2024-10-04 17:01:19'),
(11,	2,	2,	'TALLER SENSORIAL (ACOMPAÑAMIENTO)',	NULL,	't',	NULL,	'2024-10-04 17:01:19',	'2024-10-04 17:01:19'),
(12,	3,	3,	'DANZAS COREOGRÁFICAS',	NULL,	't',	NULL,	'2024-10-04 17:02:43',	'2024-10-04 17:02:43'),
(13,	3,	3,	'FOLCLÓRICOS ADULTOS (10 AÑOS A +)',	NULL,	't',	NULL,	'2024-10-04 17:02:43',	'2024-10-04 17:02:43'),
(14,	3,	3,	'BAILE CON ACOMPAÑAMIENTO (SEVERO)',	NULL,	't',	NULL,	'2024-10-04 17:02:43',	'2024-10-04 17:02:43'),
(15,	3,	3,	'MARINERA',	NULL,	't',	NULL,	'2024-10-04 17:02:43',	'2024-10-04 17:02:43'),
(16,	3,	3,	'BAILE MODERNO',	NULL,	't',	NULL,	'2024-10-04 17:02:43',	'2024-10-04 17:02:43'),
(17,	3,	3,	'FOLCLÓRICOS NIÑOS (4 -9 AÑOS)',	NULL,	't',	NULL,	'2024-10-04 17:02:43',	'2024-10-04 17:02:43'),
(18,	4,	3,	'XILÓFONO',	NULL,	't',	NULL,	'2024-10-04 17:04:13',	'2024-10-04 17:04:13'),
(19,	4,	3,	'CAJÓN BÁSICO',	NULL,	't',	NULL,	'2024-10-04 17:04:13',	'2024-10-04 17:04:13'),
(20,	4,	3,	'GUITARRA',	NULL,	't',	NULL,	'2024-10-04 17:04:13',	'2024-10-04 17:04:13'),
(21,	4,	3,	'PIANO',	NULL,	't',	NULL,	'2024-10-04 17:04:13',	'2024-10-04 17:04:13'),
(22,	4,	3,	'CORO',	NULL,	't',	NULL,	'2024-10-04 17:04:13',	'2024-10-04 17:04:13'),
(23,	5,	3,	'ATLETISMO',	NULL,	't',	NULL,	'2024-10-04 17:05:01',	'2024-10-04 17:05:01'),
(24,	5,	3,	'INICIACIÓN A NATACIÓN',	NULL,	't',	NULL,	'2024-10-04 17:05:01',	'2024-10-04 17:05:01'),
(25,	6,	2,	'PSICOMOTRICIDAD',	NULL,	't',	NULL,	'2024-10-04 17:06:30',	'2024-10-04 17:06:30'),
(26,	6,	2,	'POSTURAL',	NULL,	't',	NULL,	'2024-10-04 17:06:30',	'2024-10-04 17:06:30'),
(27,	6,	2,	'MANTENIMIENTO FUNCIONAL (SEVERO)',	NULL,	't',	NULL,	'2024-10-04 17:06:30',	'2024-10-04 17:06:30'),
(28,	6,	1,	'EJERCICIOS EN PISCINA (TERAPIA)',	NULL,	't',	NULL,	'2024-10-04 17:06:30',	'2024-10-04 17:06:30'),
(29,	7,	2,	'TALLER DE LENGUAJE EXPRESIVO',	NULL,	't',	NULL,	'2024-10-04 17:07:14',	'2024-10-04 17:07:14'),
(30,	7,	2,	'TALLER DE ESTIMULACIÓN DE LENGUAJE ORAL (NIÑOS)',	NULL,	't',	NULL,	'2024-10-04 17:07:14',	'2024-10-04 17:07:14'),
(31,	7,	2,	'TALLER DE HABILIDADES COMUNICATIVO SOCIAL',	NULL,	't',	NULL,	'2024-10-04 17:07:14',	'2024-10-04 17:07:14'),
(32,	7,	2,	'TALLER DE LENGUAJE COMPRENSIVO',	NULL,	't',	NULL,	'2024-10-04 17:07:14',	'2024-10-04 17:07:14');

DROP TABLE IF EXISTS "tipo_discapacidads";
DROP SEQUENCE IF EXISTS tipo_discapacidads_id_seq;
CREATE SEQUENCE tipo_discapacidads_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."tipo_discapacidads" (
    "id" bigint DEFAULT nextval('tipo_discapacidads_id_seq') NOT NULL,
    "tipo_discapacidad" character varying(15) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "tipo_discapacidads_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "tipo_discapacidads" ("id", "tipo_discapacidad", "created_at", "updated_at") VALUES
(1,	'MODERADA',	'2024-10-04 17:41:19',	'2024-10-04 17:41:19'),
(2,	'GRAVE',	'2024-10-04 17:41:43',	'2024-10-04 17:41:43'),
(3,	'LEVE',	'2024-10-04 17:41:43',	'2024-10-04 17:41:43'),
(4,	'SEVERA',	'2024-10-04 17:41:43',	'2024-10-04 17:41:43'),
(5,	'NINGUNA',	'2024-10-04 17:41:43',	'2024-10-04 17:41:43');

DROP TABLE IF EXISTS "tipo_personas";
DROP SEQUENCE IF EXISTS tipo_personas_id_seq;
CREATE SEQUENCE tipo_personas_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."tipo_personas" (
    "id" bigint DEFAULT nextval('tipo_personas_id_seq') NOT NULL,
    "tipo_persona" character varying(50) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "tipo_personas_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "tipo_personas" ("id", "tipo_persona", "created_at", "updated_at") VALUES
(1,	'ADMINISTRADOR',	'2024-10-04 21:55:20',	'2024-10-04 21:55:20'),
(2,	'ENCARGADO',	'2024-10-04 21:55:20',	'2024-10-04 21:55:20'),
(3,	'PADRE',	'2024-10-04 21:55:20',	'2024-10-04 21:55:20'),
(4,	'MADRE',	'2024-10-04 21:55:20',	'2024-10-04 21:55:20'),
(5,	'REPRESENTANTE LEGAL',	'2024-10-04 21:55:20',	'2024-10-04 21:55:20'),
(6,	'ALUMNO',	'2024-10-04 17:34:32',	'2024-10-04 17:34:32');

DROP TABLE IF EXISTS "tipo_seguros";
DROP SEQUENCE IF EXISTS tipo_seguros_id_seq;
CREATE SEQUENCE tipo_seguros_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."tipo_seguros" (
    "id" bigint DEFAULT nextval('tipo_seguros_id_seq') NOT NULL,
    "tipo_seguro" character varying(20) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "tipo_seguros_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "tipo_seguros" ("id", "tipo_seguro", "created_at", "updated_at") VALUES
(1,	'ESSALUD',	NULL,	NULL),
(2,	'PNP',	NULL,	NULL),
(3,	'FFAA',	NULL,	NULL),
(4,	'SIS',	NULL,	NULL),
(5,	'OTROS',	NULL,	NULL);

DROP TABLE IF EXISTS "tipo_tallers";
DROP SEQUENCE IF EXISTS tipo_tallers_id_seq;
CREATE SEQUENCE tipo_tallers_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."tipo_tallers" (
    "id" bigint DEFAULT nextval('tipo_tallers_id_seq') NOT NULL,
    "descripcion" character varying(100) NOT NULL,
    "usuario_actualiza" character varying(50),
    "deleted_at" timestamp(0),
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "tipo_tallers_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "tipo_tallers" ("id", "descripcion", "usuario_actualiza", "deleted_at", "created_at", "updated_at") VALUES
(1,	'GRUPAL',	NULL,	NULL,	'2024-10-04 16:57:29',	'2024-10-04 16:57:29'),
(2,	'INDIVIDUAL',	NULL,	NULL,	'2024-10-04 16:57:38',	'2024-10-04 16:57:38'),
(3,	'RECREATIVO',	NULL,	NULL,	'2024-10-04 16:57:44',	'2024-10-04 16:57:44');

DROP TABLE IF EXISTS "users";
DROP SEQUENCE IF EXISTS users_id_seq;
CREATE SEQUENCE users_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."users" (
    "id" bigint DEFAULT nextval('users_id_seq') NOT NULL,
    "persona_id" bigint NOT NULL,
    "email" character varying(255) NOT NULL,
    "email_verified_at" timestamp(0),
    "password" character varying(255) NOT NULL,
    "remember_token" character varying(100),
    "usuario_actualiza" character varying(50),
    "deleted_at" timestamp(0),
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "users_email_unique" UNIQUE ("email"),
    CONSTRAINT "users_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "users" ("id", "persona_id", "email", "email_verified_at", "password", "remember_token", "usuario_actualiza", "deleted_at", "created_at", "updated_at") VALUES
(1,	1,	'scorcueramel@gmail.com',	NULL,	'$2y$10$KcY4ERJo1flCwP.SIwBBJOozorrLRUQNoP4d9O.pTIewn9t3PA9rm',	NULL,	NULL,	NULL,	'2024-10-04 21:55:20',	'2024-10-04 21:55:20');

ALTER TABLE ONLY "public"."alumnos" ADD CONSTRAINT "alumnos_acred_resid_id_foreign" FOREIGN KEY (acred_resid_id) REFERENCES acreditacion_residencias(id) ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."alumnos" ADD CONSTRAINT "alumnos_anio_ingreso_id_foreign" FOREIGN KEY (anio_ingreso_id) REFERENCES anio_ingresos(id) ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."alumnos" ADD CONSTRAINT "alumnos_cond_socio_economica_id_foreign" FOREIGN KEY (cond_socio_economica_id) REFERENCES condicion_socio_economicas(id) ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."alumnos" ADD CONSTRAINT "alumnos_genero_id_foreign" FOREIGN KEY (genero_id) REFERENCES generos(id) ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."alumnos" ADD CONSTRAINT "alumnos_manif_volunta_id_foreign" FOREIGN KEY (manif_volunta_id) REFERENCES manifestacion_voluntads(id) ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."alumnos" ADD CONSTRAINT "alumnos_persona_id_foreign" FOREIGN KEY (persona_id) REFERENCES personas(id) ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."alumnos" ADD CONSTRAINT "alumnos_tipo_discapacidad_id_foreign" FOREIGN KEY (tipo_discapacidad_id) REFERENCES tipo_discapacidads(id) ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."alumnos" ADD CONSTRAINT "alumnos_tipo_seguro_id_foreign" FOREIGN KEY (tipo_seguro_id) REFERENCES tipo_seguros(id) ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."anio_ingresos" ADD CONSTRAINT "anio_ingresos_periodo_id_foreign" FOREIGN KEY (periodo_id) REFERENCES periodos(id) ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."asistencias" ADD CONSTRAINT "asistencias_inscripcion_id_foreign" FOREIGN KEY (inscripcion_id) REFERENCES inscripcions(id) ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."certificado_discapacidads" ADD CONSTRAINT "certificado_discapacidads_alumno_id_foreign" FOREIGN KEY (alumno_id) REFERENCES alumnos(id) ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."ciclo_horarios" ADD CONSTRAINT "ciclo_horarios_ciclo_id_foreign" FOREIGN KEY (ciclo_id) REFERENCES ciclos(id) ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."ciclo_horarios" ADD CONSTRAINT "ciclo_horarios_horario_id_foreign" FOREIGN KEY (horario_id) REFERENCES horarios(id) ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."ciclos" ADD CONSTRAINT "ciclos_periodo_id_foreign" FOREIGN KEY (periodo_id) REFERENCES periodos(id) ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."ciclos" ADD CONSTRAINT "ciclos_taller_id_foreign" FOREIGN KEY (taller_id) REFERENCES tallers(id) ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."diagnostico_medicos" ADD CONSTRAINT "diagnostico_medicos_alumnos_id_foreign" FOREIGN KEY (alumnos_id) REFERENCES alumnos(id) ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."encargado_ciclos" ADD CONSTRAINT "encargado_ciclos_ciclo_horario_id_foreign" FOREIGN KEY (ciclo_horario_id) REFERENCES ciclo_horarios(id) ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."encargado_ciclos" ADD CONSTRAINT "encargado_ciclos_persona_id_foreign" FOREIGN KEY (persona_id) REFERENCES personas(id) ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."espera_persona_tallers" ADD CONSTRAINT "espera_persona_tallers_persona_id_foreign" FOREIGN KEY (persona_id) REFERENCES personas(id) ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."espera_persona_tallers" ADD CONSTRAINT "espera_persona_tallers_taller_id_foreign" FOREIGN KEY (taller_id) REFERENCES tallers(id) ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."horarios" ADD CONSTRAINT "horarios_dia_id_foreign" FOREIGN KEY (dia_id) REFERENCES dias(id) ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."inscripcions" ADD CONSTRAINT "inscripcions_horario_id_foreign" FOREIGN KEY (horario_id) REFERENCES horarios(id) ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."inscripcions" ADD CONSTRAINT "inscripcions_persona_id_foreign" FOREIGN KEY (persona_id) REFERENCES personas(id) ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."personas" ADD CONSTRAINT "personas_tipo_persona_id_foreign" FOREIGN KEY (tipo_persona_id) REFERENCES tipo_personas(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."representantes" ADD CONSTRAINT "representantes_alumno_id_foreign" FOREIGN KEY (alumno_id) REFERENCES alumnos(id) ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."representantes" ADD CONSTRAINT "representantes_persona_id_foreign" FOREIGN KEY (persona_id) REFERENCES personas(id) ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."tallers" ADD CONSTRAINT "tallers_programa_id_foreign" FOREIGN KEY (programa_id) REFERENCES programas(id) ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."tallers" ADD CONSTRAINT "tallers_tipo_taller_id_foreign" FOREIGN KEY (tipo_taller_id) REFERENCES tipo_tallers(id) ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."users" ADD CONSTRAINT "users_persona_id_foreign" FOREIGN KEY (persona_id) REFERENCES personas(id) NOT DEFERRABLE;

-- 2024-10-10 11:40:15.533843-05
