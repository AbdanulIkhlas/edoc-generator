import { motion } from "framer-motion";

interface SectionHeadingProps {
  title: string;
  subtitle?: string;
  align?: "left" | "center";
}

const SectionHeading = ({ title, subtitle, align = "left" }: SectionHeadingProps) => {
  return (
    <motion.div 
      className={`mb-12 ${align === "center" ? "text-center" : ""}`}
      initial={{ opacity: 0, y: 20 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true }}
      transition={{ duration: 0.5 }}
    >
      <h2 className="text-3xl md:text-4xl font-heading font-bold text-foreground mb-3">
        {title}
      </h2>
      {subtitle && (
        <p className="text-muted-foreground text-lg">
          {subtitle}
        </p>
      )}
      <motion.div 
        className={`h-1 w-12 bg-primary rounded-full mt-4 ${align === "center" ? "mx-auto" : ""}`}
        initial={{ scaleX: 0 }}
        whileInView={{ scaleX: 1 }}
        viewport={{ once: true }}
        transition={{ duration: 0.5, delay: 0.2 }}
      />
    </motion.div>
  );
};

export default SectionHeading;
